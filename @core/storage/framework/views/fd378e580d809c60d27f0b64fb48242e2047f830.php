
<script>
$(function(){


  <?php if(Session::has('success')): ?>
    Swal.fire({
    icon: 'success',
    toast:true,
    title: 'Great!',
    text: '<?php echo e(Session::get("success")); ?>'
  })
  <?php endif; ?>

    <?php if(Session::has('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo e(Session::get("error")); ?>'
    })
    <?php endif; ?>

    <?php if(Session::has('warning')): ?>
    Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: '<?php echo e(Session::get("warning")); ?>'
    })
    <?php endif; ?>
});
</script>
<?php /**PATH /home/multistream6/domains/refugereach.help/public_html/@core/resources/views/components/sweet-alert-msg.blade.php ENDPATH**/ ?>