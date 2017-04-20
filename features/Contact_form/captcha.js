function reload()
{
    img = document.getElementById("capt");
    img.src="captcha.php";
}

$(document).ready(function()
{
    var htm='<p><img src="captcha.php" id="capt">&nbsp;<img width="30" height="30"  src="reload.png" onClick="reload();"></p>' +
        '<input type="text" name="g-recaptcha-response"> ';

    $('#custom_captcha').html(htm);
});
