<?php date_default_timezone_set('Asia/Dhaka'); ?>
<?php echo date("l, d M, Y || h:i A "); ?><br><br><br>
Assalamu Alaikum.<br><br><br>
Dear <?php echo e($name); ?>,<br><br>
Your registartion is complete. Please click the link below to active your account and confirm your email and get access.<br>
<br><hr>
Link: => <?php echo e(route('confirmation', $token)); ?> <br>
<hr><br><br><br>
------------------------<br>
regards<br>
<br>
Authority<br>
Transport Management Division,<br>
International Islamic Universty Chittagong.<br>
<hr>
<br><br><br><br>
