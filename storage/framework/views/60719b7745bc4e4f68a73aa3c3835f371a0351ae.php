
<?php
$auth_user= authSession();
?>
<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="<?php echo e(route('showUserDetails', ['userId' => $booking->user->id])); ?>" >
        <i class="far fa-eye  "></i>
    </a>
</div>
<?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/booking/action.blade.php ENDPATH**/ ?>