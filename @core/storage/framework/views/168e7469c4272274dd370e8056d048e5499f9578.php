$(document).on('click','#search',function () {
    $(this).addClass("disabled")
    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e(__("Searching..")); ?>');
});<?php /**PATH /home/xgenxchi/fundorex.xgenious.com/@core/resources/views/components/btn/search.blade.php ENDPATH**/ ?>