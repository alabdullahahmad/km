<?php
$auth_user = authSession();
?>
<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="{{ route('showUserDetails', ['userId' => $booking->user->id]) }}">
        <i class="far fa-eye"></i>
    </a>
    <a class="mr-3" href="#" onclick="recordEntry('<?php echo $booking->subscription->name; ?>', '<?php echo $booking->user->id; ?>' ,'<?php echo $booking->id; ?>')">
        <i class="fas fa-door-open text-success"></i>
    </a>
</div>

<script>
    function recordEntry(name, userId ,billId) {
        // إرسال البيانات إلى الخادم باستخدام AJAX
        $.ajax({
            url: "{{ route('addPlayerLoginLog') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            contentType: "application/json",
            data: JSON.stringify({ subscription_name: name, user_id: userId , billId : billId }),
            success: function (data) {
                console.log(data);
                
                if (data.data.success == true) {
                    alert('تم دخول اللاعب بنجاح');
                } else {
                    alert('حدث خطأ أثناء تسجيل الدخول');
                }
            },
            error: function (xhr) {
            try {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
            } catch (e) {
                alert("خطأ غير متوقع.");
            }
            }


        });
    }
</script>

