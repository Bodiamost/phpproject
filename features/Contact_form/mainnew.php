<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src='captcha.js'></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contact Form</title>
</head>
<body>
<form action="indexnew.php" id="contact" method="post">
    <fieldset>
        <legend>Contact Us</legend>

        <div class="container">
            <label for="name">Name: </label><br/>
            <input type="text" name="u_name" value="<?php echo $name;?>" required>
        </div>

        <div class="container">
            <label for="email">Email: </label><br/>
            <input type="email" name="u_email" value="<?php echo $email;?>" required>
        </div>

        <div class="container">
            <label for="subject">Subject: </label><br/>
            <input type="text" name="subj" value="<?php echo $subj;?>" required>
        </div>

        <div class="container">
            <label for="message">Message:</label><br/>
            <textarea rows="10" cols="50" name='message' type="text" id='message' value="<?php echo $message;?>" required>
            </textarea>
        </div>

        <div class="container">
            <label for="scaptcha">Enter Image Text below:</label>
            <div id="custom_captcha"></div>
            <?php echo $error;?>
        </div>
        <div class="container">
            <input type="submit" name="submit" value="Submit">
        </div>
    </fieldset>
</form>
</body>
</html>