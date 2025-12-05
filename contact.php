<?php 
$email_sent = false;
if(isset($_POST['submitEmail'])){

    // Fields for mail()
    $to = "cpbarrett9@gmail.com";
    $from = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "wgtnstreetscans.com - Message from ".$first_name." ".$last_name;
    $message = "Email: ".$from."<br>".$_POST['message'];

    // Sending(?) and setting $email_sent to true (displayed email send message):
    mail($to, $subject, $message);
    $email_sent = true;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wellington Street Scans - Contact</title>
        <meta charset="UTF-8">
        <meta name="description" content="Library of urban scans taken in Wellington, NZ">
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav id="nav">
            ❇&emsp;<a href="index.php">GALLERY</a>&emsp;//&emsp;
            <a href="about.php">ABOUT</a>&emsp;//&emsp;
            <a href="contact.php">CONTACT</a>&emsp;❇
        </nav>
        <!-- Form that sends an email: -->
         <div id="scanContainer">
            <?php if ($email_sent) { ?>
                <h3 id="sentConfirmation">Message sent.</h3>
            <?php } else { ?>
                <form action="" method="post" id="emailForm">
                    <br>Your First Name: <br><br><input type="text" name="first_name"><br><br>
                    Your Last Name:  <br><br><input type="text" name="last_name"><br><br>
                    Your Email: <br><br><input type="email" name="email"><br><br><br>
                    Message:  <br><br><textarea rows="5" name="message" cols="30"></textarea><br>
                    <br><input type="submit" name="submitEmail" value="Submit">
                </form>
            <?php } ?>
         </div>
    <script src="script.js"></script>
    </body>
</html>