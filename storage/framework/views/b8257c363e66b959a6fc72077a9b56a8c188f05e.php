<?php if(isset($query->author)): ?>
  <div class="d-flex gap-3 align-items-center">
    <img src="<?php echo e(getSingleMedia(optional($query->author),'profile_image', null)); ?>" alt="avatar" class="avatar avatar-40 rounded-pill">
    <div class="text-start">
      <h6 class="m-0"><?php echo e(optional($query->author)->display_name); ?></h6>
      <span><?php echo e(optional($query->author)->email ?? '--'); ?></span>
    </div>
  </div>
  <?php else: ?>

<div class="align-items-center">
    <h6 class="text-center"><?php echo e('-'); ?> </h6>
</div>
<?php endif; ?>




<?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/blog/user.blade.php ENDPATH**/ ?>