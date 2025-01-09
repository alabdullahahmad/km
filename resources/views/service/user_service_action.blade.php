<?php
    $auth_user= authSession();
?>

<div class="d-flex justify-content-end align-items-center">
    <a class="mr-3" href="{{ route('', $bill->id) }}" data--submit="bill{{ $bill->id }}"
        <i class="far fa-eye"></i>
    </a>
    <a class="mr-3" href="#" onclick="recordEntry('<?php echo $booking->subscription->name; ?>', '<?php echo $booking->user->id; ?>')">
        <i class="fas fa-door-open text-success"></i>
    </a>
</div>

