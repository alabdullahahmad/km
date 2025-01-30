
<?php
    $auth_user= authSession();
?>
<div class="d-flex  align-items-center">
        @if ($auth_user->can('bills edit'))
        <a class="mr-2" href="{{ route('wallet.create',['id' => $wallet->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.wallet') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
        @endif
        @if($auth_user->can('bills delete'))
        <a class="mr-2 text-danger" href="{{ route('delelteBill', ['billId' => $wallet->id]) }}" data--submit="wallet{{$wallet->id}}"
            data--confirmation='true'
            data--ajax="true"
            data-datatable="reload"
            data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.provider') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.provider') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt"></i>
        </a>
        @endif
    </div>

