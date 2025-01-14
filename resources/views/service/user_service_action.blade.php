<?php
    $auth_user= authSession();
?>

<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="{{ route('handymantype.index', ['billId' => $billId]) }}" data--submit="bill{{ $billId }}">
        <i class="far fa-eye"></i>
    </a>
</div>

