<?php

$conn = new mysqli("localhost", "root", "", "test1");
if($conn->connect_error){
  die("Connection Failed:" . $conn->connect_error);
}

if(isset($_POST["submit"])){
	      $user_type = "student";
	      $username = $_POST["username"];
          $year = $_POST["year"];
          $email = $_POST["mail"];
          $mailid = $email;
          $password = $_POST["password1"];
          $password1 = $_POST["password2"];
          $pass = md5($password);
          if($password==$password1){
              	
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
$mail->addAddress("$mailid"); //TOMAIL

//Change to whom you want to send.
$mail->addReplyTo("missbella.teachera@gmail.com", "TEACHERA");

// Content
$mail->isHTML(true);  // Set email format to HTML

//Change the subject.
$mail->Subject = 'Welcome to TEACHERA!';

//Change the content as per your wish.
$mail->Body    = '<h1>Congratulations!</h1><h2>You have signed up as a student in TEACHERA.</h2><h3>This is an automated e-mail from TEACHERA. Please do not reply back to this e-mail.</h3>';

//For client not supporting HTML rendering.
$mail->AltBody = 'Congratulations! You have signed up as a student in TEACHERA.This is an automated e-mail from TEACHERA. Please do not reply back to this e-mail.';
                $stmt = $conn->prepare("INSERT INTO signup (username, year, email, password, user_type) 
		            values(?,?,?,?,?)");
  	            $stmt->bind_param("sisss", $username, $year, $email, $pass, $user_type);
                $stmt->execute();
                echo "<script>alert('Account created successfully');</script>";
                $stmt->close();
                $conn->close();
            }
                
          else{
	            echo "Password doesn't match";
           }
}
else{
	echo "ERROR";
} 

?>