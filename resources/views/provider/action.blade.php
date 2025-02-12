
<?php
$auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteStaf', $provider->id], 'method' => 'delete','data--submit'=>'provider'.$provider->id]) }}
<div class="d-flex  align-items-center">
{{-- <a class="mr-2" href="{{ route('provider.time-slot',['id' => $provider->id]) }}" title="{{ __('messages.My_time_slot',['form' => __('messages.provider') ]) }}"><i class="fa fa-clock text-primary "></i></a> --}}


    @if($auth_user->can('receptions edit'))
    <a class="mr-2" href="{{ route('provider.create',['id' => $provider->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.provider') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
    @endif
    @if($auth_user->can('receptions delete'))
    <a class="mr-2 text-danger" href="{{ route('deleteStaf', $provider->id) }}" data--submit="provider{{$provider->id}}"
        data--confirmation='true'
        data--ajax="true"
        data-datatable="reload"
        data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.provider') ]) }}"
        title="{{ __('messages.delete_form_title',['form'=>  __('messages.provider') ]) }}"
        data-message='{{ __("messages.delete_msg") }}'>
        <i class="far fa-trash-alt"></i>
    </a>
    @endif
   <a class="mr-2 text-success" href="#" onclick="addFingerprint('{{ $provider->id }}', '{{ $provider->name }}', '{{ $provider->branchId }}')">
    <i class="fas fa-fingerprint"></i>
    </a>
 
    

</div>
<script>
      function addFingerprint(id, name ,branchId) {


        console.log("Branch ID:", id,name,branchId);

        $.ajax({
            url: `http://localhost:3003/user/${id}`,
            type: 'POST',
            data: {
                username: 'staf',
                fingerId: id,
                branchId: branchId,
                // _token: '{{ csrf_token() }}',
            },
            beforeSend: function () {
                $('#fingerprint-{{$provider->id}}').prop('disabled', true).text('جاري الإضافة...');
            },
            success: function (response) {
                console.log(response);
                if (response.status === 200 || response.success) {
                    alert('الرجاء التحقق من البصمة');
                    location.reload();
                } else {
                    alert('الرجاء التحقق من البصمة');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('حدث خطأ أثناء معالجة الطلب: ' + xhr.responseText);
            },
            complete: function () {
                $('#fingerprint-{{$provider->id}}').prop('disabled', false).text('{{ __('messages.add_fingerprint') }}');
            }
        });

}


</script>

{{ Form::close() }}
