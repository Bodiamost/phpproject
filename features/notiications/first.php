<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notifications Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js" type="text/javascript"></script>
</head>

<div id="container">
    <?php notification(); ?>
    <div class="alert">
        <form action="<?php submitForm(); ?>" method="post">
            <label for="name">Message</label>
            <input type="text" name="name" id="name" />

        </form>
<body>
     </div>
 </div>
</body>

</html>
