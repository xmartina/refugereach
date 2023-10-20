<?php

namespace App\Http\Controllers\Admin;
use App\Country;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FrontendUserManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete',['only' => ['all_user']]);
        $this->middleware('permission:user-create',['only' => ['new_user','new_user_add']]);
        $this->middleware('permission:user-delete',['only' => ['bulk_action','new_user_delete']]);
        $this->middleware('permission:user-edit',['only' => ['user_password_change','user_update','email_status']]);
    }
    public function all_user()
    {
        $all_user = User::all();
        $all_countries = Country::select('id','name')->get();
        return view('backend.frontend-user.all-user')->with(['all_user' => $all_user, 'all_countries' => $all_countries]);
    }
    public function user_password_change(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|string|min:8|confirmed'
            ],
            [
                'password.required' => __('password is required'),
                'password.confirmed' => __('password does not matched'),
                'password.min' => __('password minimum length is 8'),
            ]
        );
        $user = User::findOrFail($request->ch_user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(['msg' => __('Password Change Success..'), 'type' => 'success']);
    }
    public function user_update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,id,'.$request->user_id,
            'address' => 'nullable|string|max:191',
            'zipcode' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'state' => 'nullable|string|max:191',
            'country_id' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
        ], [
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
        ]);
        User::find($request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'state' => $request->state,
            'country_id' => $request->country_id,
            'phone' => $request->phone,
        ]);
        return redirect()->back()->with(['msg' => __('User Profile Update Success..'), 'type' => 'success']);
    }
    public function new_user_delete(Request $request, $id)
    {
        User::find($id)->delete();
        return redirect()->back()->with(['msg' => __('User Profile Deleted..'), 'type' => 'danger']);
    }

    public function new_user()
    {
        $all_countries = Country::select('id','name')->get();
        return view('backend.frontend-user.add-new-user',compact('all_countries'));
    }

    public function new_user_add(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:191|unique:users',
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191|unique:users',
            'address' => 'nullable|string|max:191',
            'zipcode' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'state' => 'nullable|string|max:191',
            'country_id' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'state' => $request->state,
            'country_id' => $request->country_id,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with(['msg' => __('New User Created..'), 'type' => 'success']);
    }

    public function bulk_action(Request $request)
    {
        $all = User::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function email_status(Request $request)
    {
        User::where('id', $request->user_id)->update([
            'email_verified' => $request->email_verified == 0 ? 1 : 0
        ]);
        return redirect()->back()->with(['msg' => __('Email Verify Status Changed..'), 'type' => 'success']);
    }

    public function campaign_permission(Request $request)
    {
        $user = User::find($request->user_id);
        $user->campaign_permission = !empty($request->campaign_permission) ? $request->campaign_permission : 'off';
        $user->save();

        return redirect()->back()->with(['msg' => __('Campaign Permission Changed'), 'type' => 'success']);
    }

    public function user_tax_view($id)
    {
        if(!empty($id)){
            $user_tax = User::find($id);
        }
        return view('backend.frontend-user.tax-data')->with(['user_tax' => $user_tax]);
    }

    public function user_verify_view($id)
    {
        $user_verify = User::findOrFail($id);
        return view('backend.frontend-user.verify-data')->with(['user_verify' => $user_verify]);
    }

    public function user_verify_update($id)
    {
        $user = User::findOrFail($id);
        $user->user_verify_status = 2;
        $user->save();

        return redirect()->back()->with(['msg' => __('User Verified Successfully..!'), 'type' => 'success']);
    }

}
