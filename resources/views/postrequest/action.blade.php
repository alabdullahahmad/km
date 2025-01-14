
<?php
$auth_user= authSession();
?>
<div class="d-flex  align-items-center">
    <a class="mr-3" href="{{ route('fundReportDetails', ['startDate' => $date,'endDate'=>$date]) }}" >
        <i class="far fa-eye  "></i>
    </a>
</div>
