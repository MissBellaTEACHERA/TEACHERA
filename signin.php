<?php       
      
    $conn = mysqli_connect("localhost", "root", "", "test1");  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    } 
    $email = $_POST['email'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $email = mysqli_real_escape_string($conn, $email);  
        $password = mysqli_real_escape_string($conn, $password); 
        $pass = md5($password); 
      
        $sql = "SELECT * FROM signup where email = '$email' and password = '$pass'";         
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  

        if($count == 1){  
            //Make sure you import it correctly.
require "phpmailer/PHPMailerAutoload.php";

//Setup   
$mail=new PHPMailer;
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'missbella.teachera@gmail.com';                     // SMTP username
$mail->Password   = 'bnmfghwer123';                               // SMTP password
$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
$mail->Port       = 587;                  
                  
//FROM email
$mail->setFrom("missbella.teachera@gmail.com", "TEACHERA");

//Change to from eamil
$mail->addAddress("$email"); //TOMAIL

//Change to whom you want to send.
$mail->addReplyTo("missbella.teachera@gmail.com", "TEACHERA");

// Content
$mail->isHTML(true);  // Set email format to HTML

//Change the subject.
$mail->Subject = 'Sign in alert to your TEACHERA account!';

//Change the content as per your wish.
$mail->Body    = '<h1>Alert!</h1><h2>New sign in detected to your TEACHERA account.</h2><h3>This is an automated e-mail from TEACHERA. Please do not reply back to this e-mail.</h3>';

//For client not supporting HTML rendering.
$mail->AltBody = 'Alert! New sign in detected to your TEACHERA account.This is an automated e-mail from TEACHERA. Please do not reply back to this e-mail.';
echo "<h1><center> Login successful </center></h1>";   
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?> 