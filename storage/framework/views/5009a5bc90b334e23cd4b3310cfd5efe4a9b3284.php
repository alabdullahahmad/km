<?php
$auth_user = authSession();
?>
<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="<?php echo e(route('showUserDetails', ['userId' => $booking->user->id])); ?>">
        <i class="far fa-eye"></i>
    </a>
    <a class="mr-3" href="#" onclick="recordEntry('<?php echo $booking->subscription->name; ?>', '<?php echo $booking->user->id; ?>')">
        <i class="fas fa-door-open text-success"></i>
    </a>
</div>

<script>
    function recordEntry(name, userId) {
        // إرسال البيانات إلى الخادم باستخدام AJAX
        $.ajax({
            url: "<?php echo e(route('addPlayerLoginLog')); ?>",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            contentType: "application/json",
            data: JSON.stringify({ subscription_name: name, user_id: userId }),
            success: function (data) {
                console.log(data);
                
                if (data.data.success == true) {
                    alert('تم دخول اللاعب بنجاح');
                } else {
                    alert('حدث خطأ أثناء تسجيل الدخول');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('حدث خطأ أثناء الاتصال بالخادم');
            }
        });
    }
</script>

<?php /**PATH C:\Users\USER\Desktop\km\resources\views/booking/action.blade.php ENDPATH**/ ?>