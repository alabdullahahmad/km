
<?php
$auth_user= authSession();
?>
<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="{{ route('showUserDetails', ['userId' => $booking->user->id]) }}" >
        <i class="far fa-eye  "></i>
    </a>
</div>