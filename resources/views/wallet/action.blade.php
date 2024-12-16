
<?php
    $auth_user= authSession();
?>
@if(auth()->user()->hasAnyRole(['admin','demo_admin','Viewing']))
<div class="d-flex justify-content-end align-items-center">
        <a class="mr-2" href="{{ route('wallet.create',['id' => $wallet->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.wallet') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
    </div>
@endif
{{ Form::close() }}
