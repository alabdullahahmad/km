<?php 
$settings = App\Models\Setting::where('type', 'OTHER_SETTING')->where('key','OTHER_SETTING')->first();
$othersetting = json_decode($settings->value);
$onlinepayment = $othersetting->online_payment;
?>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs pay-tabs nav-fill tabslink" id="tab-text" role="tablist">
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=cash" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='cash'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.cod')); ?></a>
            </li>
            <?php if($onlinepayment == 1): ?>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=stripe" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='stripe'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.stripe')); ?></a>
            </li>

            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=maya" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='maya'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.maya')); ?></a>
            </li>

            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=razorPay" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='razorPay'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.razor')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=flutterwave" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='flutterwave'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.flutterwave')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=paypal" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='paypal'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.paypal')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=cinet" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='cinet'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.cinet')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=sadad" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='sadad'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.sadad')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=airtel" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='airtel'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.airtel_money')); ?></a>
            </li>

              <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=paystack" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='airtel'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.paystack')); ?></a>
            </li>

             <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=phonepe" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='airtel'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.phonepe')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('payment_layout_page')); ?>?tabpage=midtrans" data-target=".payment_paste_here" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='airtel'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.midtrans')); ?></a>
            </li>
            <?php endif; ?>
        </ul>
        <div class="card payment-content-wrapper">
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent-1">
                    <div class="tab-pane active p-1" >
                        <div class="payment_paste_here"></div>


                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<script>
    $(document).ready(function(event)
    {
        var $this = $('.payment-link').find('a.active');
        loadurl = '<?php echo e(route('payment_layout_page')); ?>?tabpage=<?php echo e($tabpage); ?>';

        targ = $this.attr('data-target');
        
        id = this.id || '';

        $.post(loadurl,{ '_token': $('meta[name=csrf-token]').attr('content') } ,function(data) {
            $(targ).html(data);
        });

        $this.tab('show');
        return false;
    });
</script><?php /**PATH C:\Users\USER\Desktop\km\resources\views/setting/payment-setting.blade.php ENDPATH**/ ?>