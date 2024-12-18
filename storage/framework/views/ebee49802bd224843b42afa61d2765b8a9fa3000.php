<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs pay-tabs nav-fill tabslink" id="tab-text" role="tablist">
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('role_layout_page')); ?>?tabpage=role" data-target=".role_permission_tab" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='role'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.role')); ?></a>
            </li>
            <li class="nav-item payment-link">
                <a href="javascript:void(0)" data-href="<?php echo e(route('role_layout_page')); ?>?tabpage=permission" data-target=".role_permission_tab" data-toggle="tabajax"  class="nav-link  <?php echo e($tabpage=='permission'?'active':''); ?>"   rel="tooltip"> <?php echo e(__('messages.permission')); ?></a>
            </li>
          
        </ul>
        <div class="card payment-content-wrapper">
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent-1">
                    <div class="tab-pane active p-1" >
                        <div class="role_permission_tab"></div>


                    
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
        loadurl = '<?php echo e(route('role_layout_page')); ?>?tabpage=<?php echo e($tabpage); ?>';

        targ = $this.attr('data-target');
        
        id = this.id || '';

        $.post(loadurl,{ '_token': $('meta[name=csrf-token]').attr('content') } ,function(data) {
            $(targ).html(data);
        });

        $this.tab('show');
        return false;
    });
</script><?php /**PATH C:\Users\USER\Desktop\km\resources\views/setting/role-permission-setup.blade.php ENDPATH**/ ?>