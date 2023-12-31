<?php $default_lang = get_default_language(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title><?php echo e(__('Payment Success For')); ?> <?php echo e(get_static_option('site_title')); ?></title>
    <style>
        *{
            font-family: 'Montserrat', sans-serif;
        }
        body {
            background-color: #fdfdfd;
        }
        .mail-container {
            max-width: 650px;
            margin: 50px auto;
            text-align: center;
        }

        .mail-container .logo-wrapper {
            padding: 20px 0 20px;
            border-bottom: 5px solid <?php echo e(get_static_option('site_color')); ?>;
        }
        table {
            margin: 0 auto;
        }
        table {

            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid rgba(0,0,0,.05);
            padding: 10px 20px;
            background-color: #fafafa;
            text-align: left;
            font-size: 14px;
            text-transform: capitalize;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: <?php echo e(get_static_option('site_color')); ?>;
            color: white;
        }
        footer {
            margin: 20px 0;
            font-size: 14px;
        }
        .main-content-wrap {
            background-color: #fff;
            box-shadow: 0 0 15px 0 rgba(0,0,0,.05);
            padding: 30px;
        }

        .main-content-wrap p {
            margin: 0;
            text-align: left;
            font-size: 14px;
            line-height: 26px;
        }

        .main-content-wrap p:first-child {
            margin-bottom: 10px;
        }

        .main-content-wrap .price-wrap {
            font-size: 60px;
            line-height: 70px;
            font-weight: 600;
            margin: 40px 0;
        }
        table {
            margin-bottom: 30px;
        }
        .logo-wrapper img{
            max-width: 200px;
        }
    </style>
</head>
<body>
<div class="mail-container">
    <div class="logo-wrapper">
        <a href="<?php echo e(url('/')); ?>">
            <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

        </a>
    </div>
    <div class="main-content-wrap">
        <p><?php echo e(__('Hello')); ?></p>
        <?php if($type == 'customer'): ?>
        <p><?php echo e(__('A payment from')); ?> <?php echo e($data->name); ?> <?php echo e(__('was successful. Donation Log ID')); ?> #<?php echo e($data->id); ?> ,<?php echo e(__('Donated cause')); ?> "<?php echo e(optional($data->cause)->title); ?>" <?php echo e(__('Paid Via')); ?> <?php echo e(ucfirst(str_replace('_',' ',$data->payment_gateway))); ?></p>
            <br>
            <?php if(!empty($data->gift)): ?>
                <strong><?php echo e(__('(You will get donation gift very soon according your provided address)')); ?></strong>
            <?php endif; ?>
        <?php else: ?>
            <p><?php echo e(__('You get payment from')); ?> <?php echo e($data->name); ?> <?php echo e(__('For donation log ID') .'#'); ?> <?php echo e($data->id); ?>, <?php echo e(__('donated cause')); ?> <?php echo e(optional($data->cause)->title); ?> <?php echo e(__('paid via')); ?> <?php echo e(ucfirst(str_replace('_',' ',$data->payment_gateway))); ?></p>
        <?php endif; ?>
        <div class="price-wrap"><?php echo e(amount_with_currency_symbol($data->amount)); ?></div>
        <table>
            <tr>
                <td><?php echo e(__('Donate ID')); ?></td>
                <td>#<?php echo e($data->id ?? ''); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Cause Name')); ?></td>
                <td><?php echo e(optional($data->cause)->title ?? ''); ?></td>
            </tr>

            <?php if(!empty($data->gift)): ?>
                <tr>
                    <td><?php echo e(__('Gift Title')); ?></td>
                    <td>
                        <?php echo e(optional($data->gift)->title ?? ''); ?>

                    </td>
                </tr>

                <tr>
                    <?php
                        $gifts = optional($data->gift)->gifts ;
                    ?>
                    <td><?php echo e(__('Gifts')); ?>:</td>
                    <td>
                        <?php $__currentLoopData = json_decode($gifts) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="color: blue"><?php echo e($item); ?>,</span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo e(__('Gift Delivery Date : ')); ?></td>
                    <td>
                        <?php echo e(optional($data->gift)->delivery_date ?? ''); ?>

                    </td>
                </tr>

            <?php endif; ?>

            <tr>
                <td><?php echo e(__('Other Informations : ')); ?></td>
                <td>
                    <?php
                        $all_custom_fields = json_decode($data->custom_fields) ?? [];
                    ?>
                    <?php if(!empty($all_custom_fields)): ?>
                        <?php $__currentLoopData = $all_custom_fields ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <small class="d-block"><strong class="text-dark "><?php echo e(ucfirst($key) . ' : '); ?></strong><?php echo e($field); ?></small>
                            <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <td><?php echo e(__('Donate Amount')); ?></td>
                <td><?php echo e(amount_with_currency_symbol($data->amount)); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Payment Gateway')); ?></td>
                <td><?php echo e(ucfirst(str_replace('_',' ',$data->payment_gateway))); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Payment Status')); ?></td>
                <td><?php echo e($data->status); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Transaction ID')); ?></td>
                <td><?php echo e($data->transaction_id); ?></td>
            </tr>
        </table>
    </div>
    <footer>
        <?php echo get_footer_copyright_text(); ?>

    </footer>
</div>
</body>
</html>
<?php /**PATH /home/xgenxchi/public_html/laravel/fundorex/@core/resources/views/mail/donation-payment-success.blade.php ENDPATH**/ ?>