

<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "newrenti";
$connection = mysqli_connect($host, $user, $password, $database);
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


	if(isset($_POST['forgotpass'])) {
		$errMsg = '';

		// Getting data from FROM
		$email = $_POST['email']; 
try
{

		$query = mysqli_query($connection, "SELECT * FROM broker WHERE email='$email'");
		$num = mysqli_fetch_assoc($query);
							if ($num) {
					        

					$receiver_email = "{$email}";
					$receiver_name = "{$num['username']}";
					$sender_mail = "brokersbunchsem6@gmail.com";
					$sender_password = "Rockstarnj27";
					$sender_name = "ADMIN@brokersbunch";
					$mail_subject = "Forgot Password";
					$mail_msg = "Hello $receiver_name ,  Your Password is '{$num['password']}'";

					require '../mail/autoload.php';
					$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
					try {
					    //Server settings

					    $mail->SMTPDebug = 0;

					    $mail->isSMTP();
					    $mail->Host = 'smtp.gmail.com';
					    $mail->SMTPAuth = true;
					    $mail->Username = "$sender_mail";                 // SMTP username
					    $mail->Password = "$sender_password";
					    $mail->SMTPSecure = 'tls';
					    $mail->Port = 587;

					    $mail->SMTPOptions = array(
					        'ssl' => array(
					            'verify_peer' => false,
					            'verify_peer_name' => false,
					            'allow_self_signed' => true
					        )
					    );



					    //Recipients
					    $mail->setFrom("$sender_mail", "$sender_name");
					    $mail->addAddress($receiver_email, $receiver_name);     // Add a recipient
					    //Content
					    $mail->isHTML(true);                                  // Set email format to HTML
					    $mail->Subject = "$mail_subject";
					    $mail->Body = "$mail_msg";

					    $mail->send();
					    echo "<script>alert('Email Sent');</script>";
					//    header("Location:enterotp.php");
					} catch (Exception $e) {
					     echo "<script>alert('Something Went Wrong!')</script>";
					}
					  
					    } else {
					       echo "<script>alert('Email Address Not Found !')</script>";
					    }
		


		try
		{
				$query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
					$num = mysqli_fetch_assoc($query);
							if ($num) {
					        

					$receiver_email = "{$email}";
					$receiver_name = "{$num['username']}";
					$sender_mail = "brokersbunchsem6@gmail.com";
					$sender_password = "Rockstarnj27";
					$sender_name = "ADMIN@brokersbunch";
					$mail_subject = "Forgot Password";
					$mail_msg = "Hello $receiver_name ,  Your Password is '{$num['password']}'";

					require '../mail/autoload.php';
					$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
					try {
					    //Server settings

					    $mail->SMTPDebug = 0;

					    $mail->isSMTP();
					    $mail->Host = 'smtp.gmail.com';
					    $mail->SMTPAuth = true;
					    $mail->Username = "$sender_mail";                 // SMTP username
					    $mail->Password = "$sender_password";
					    $mail->SMTPSecure = 'tls';
					    $mail->Port = 587;

					    $mail->SMTPOptions = array(
					        'ssl' => array(
					            'verify_peer' => false,
					            'verify_peer_name' => false,
					            'allow_self_signed' => true
					        )
					    );



					    //Recipients
					    $mail->setFrom("$sender_mail", "$sender_name");
					    $mail->addAddress($receiver_email, $receiver_name);     // Add a recipient
					    //Content
					    $mail->isHTML(true);                                  // Set email format to HTML
					    $mail->Subject = "$mail_subject";
					    $mail->Body = "$mail_msg";

					    $mail->send();
					    echo "<script>alert('Email Sent');</script>";
					//    header("Location:enterotp.php");
					} catch (Exception $e) {
					     echo "<script>alert('Something Went Wrong!')</script>";
					}
					  
					    } else {
					       echo "<script>alert('Email Address Not Found !')</script>";
					    }








		}
		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}


}

		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}


	}
?>
<?php include '../include/header.php';?>
	<!-- Services -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../finallogo.png" height="5%" width="40%" border=solid></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <!-- <a class="nav-link" href="login.php">Login</a> -->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<header class="bimage">
    <section id="services">
		<div class="container">
			<div class="row">				
			  <div class="col-md-4 mx-auto">
			  	<div class="alert alert-info" role="alert">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>

	<div align="center">
		<div style=" border: solid 1px #006D9C; " align="left">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b>Forgot Password</b></div>
			<?php
				if(isset($viewpass)){
					echo '<div style="color:#198E35;text-align:center;font-size:17px;margin-top:5px">'.$viewpass.'</div>';
				}
			?>
			<div style="margin: 15px">
				<form action="" method="post">
					 <label for="Email">Email Address</label>
					<input type="text" name="email" placeholder="Email" class="box" required /><br /><br />
					<input type="submit" name='Submit' value="Submit" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</header>
