<?php
session_start();
function submitForm()
{
    if(isset($_POST['submit']))
    {
      notify('positive','Hello,' .$_POST['name'].'');
    }
}
function notify($type ='neutral', $message = 'Have a great time, Friends!')
{
  $_SESSION['notify']['type'] = $type;
  $_SESSION['notify']['message'] = $message;
}
function notification()  //every time when loads, this function loads
{
    if(isset($_SESSION['notify']))
    {
        $type = $_SESSION['notify']['type'];
        $message = $_SESSION['notify']['message'];

        $html = '<div class="notify '. $type.'">'.$message.'</div>';

        echo $html;
       unset($_SESSION['notify']);

    }
}
?>