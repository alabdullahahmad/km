<?php
$auth_user= authSession();
?>
<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="<?php echo e(route('classReportDetails', ['coachId' => $coachId,'subscriptionId' => $subscriptionId])); ?>" >
        <i class="far fa-eye  "></i>
    </a>
</div>
<?php /**PATH /home/kmpower/public_html/resources/views/payment/action.blade.php ENDPATH**/ ?>