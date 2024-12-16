<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                
                <div class="card">
                    <div class="card-body p-30">
                        <div class="service-man-list">
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $handyman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // تحديد حالة المبلغ لكل حرفي
                                $is_ready_to_receive = true ;//$handyman->amount_status == 'ready'; // افتراض أن `amount_status` هي الحقل الذي يحتوي على حالة المبلغ
                            ?>
                            <div class="service-man-list__item">
                                <div class="service-man-list__item_header">
                                    <h4 class="service-man-name"><?php echo e($handyman->staf->name ?? '-'); ?></h4>
                                    <a class="service-man-phone" href="tel:<?php echo e($handyman->staf->phoneNumber); ?>"><?php echo e($handyman->staf->phoneNumber ?? '-'); ?></a>
                                </div>

                                <div class="service-man-list__item_body">
                                    <p class="service-man-amount"><?php echo e(__('messages.amount_due')); ?>: <?php echo e($handyman->amount ?? '-'); ?></p>
                                    <?php if($is_ready_to_receive): ?>
                                        <form action="<?php echo e(route('editFundLog')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('post'); ?>
                                        <input type="hidden" value="<?php echo e($handyman->id); ?>" name="fundLogId">
                                        <p style="color: green;"><?php echo e(__('messages.ready_to_receive')); ?></p>
                                        <button type="submit" class="btn btn-success"><?php echo e(__('messages.receive')); ?></button>
                                        </form>
                                    <?php else: ?>
                                        <p style="color: red;"><?php echo e(__('messages.processing_amount')); ?></p>
                                        <button class="btn btn-secondary" disabled><?php echo e(__('messages.receive')); ?></button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php echo e(Form::close()); ?>

    <?php $__env->startSection('bottom_script'); ?>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH /home/kmpower/public_html/resources/views/handyman/view.blade.php ENDPATH**/ ?>