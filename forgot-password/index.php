<?php
if (isset($_POST['submit']))
{
$conn=mysqli_connect("localhost","root","","tawasul_db");
$email = $_POST['email'];
// Generate a unique forgot password token
$forgot_password_token = md5(uniqid());
// Save the forgot password token to the database
$sql = "UPDATE tawasul_users SET forgot_password_token = '$forgot_password_token', forgot_password_token_expires = NOW() + INTERVAL 1 DAY WHERE email = '$email'";
mysqli_query($conn, $sql);

// Send the forgot password email
// Set the email address and subject
$to = $email;
$subject = 'Forgot password';

// Set the body of the email
$body = 'Please click this button to reset your password: <a href="http://localhost/tawasul/forgot-password/reset-password.php?token=' . $forgot_password_token . '">Reset password</a>';

// Send the email
mail($to, $subject, $body);

echo "An email has been sent to your inbox with instructions on how to reset your password.";
}
?>
<html>
  <head>
  <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="..\css\style.css">

<!------------------LIght BOx for Gallery-------------->
<link rel="stylesheet" href="..\components\lightbox\lightbox.min.css">
<script type="text/javascript" src="..\components\lightbox\lightbox-plus-jquery.min.js"></script>
<!------------------LIght BOx for Gallery-------------->
    <title>Forgot Password</title>
<style>
			html {
    height: 100%;
}
body {
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

/* Text Align */
.text-c {
    text-align: center;
}
.text-l {
    text-align: left;
}
.text-r {
    text-align: right
}
.text-j {
    text-align: justify;
}

/* Text Color */
.text-whitesmoke {
    color: whitesmoke
}
.text-darkyellow {
    color: rgba(255, 235, 59, 0.432)
}

/* Lines */

.line-b {
    border-bottom: 1px solid #FFEB3B !important;
}

/* Buttons */
.button {
    border-radius: 3px;
}
.form-button {
    background-color: rgba(255, 235, 59, 0.24);
    border-color: rgba(255, 235, 59, 0.24);
    color: #e6e6e6;
}
.form-button:hover,
.form-button:focus,
.form-button:active,
.form-button.active,
.form-button:active:focus,
.form-button:active:hover,
.form-button.active:hover,
.form-button.active:focus {
    background-color: rgba(255, 235, 59, 0.473);
    border-color: rgba(255, 235, 59, 0.473);
    color: #e6e6e6;
}
.button-l {
    width: 100% !important;
}

/* Margins g(global) - l(left) - r(right) - t(top) - b(bottom) */

.margin-g {
    margin: 15px;
}
.margin-g-sm {
    margin: 10px;
}
.margin-g-md {
    margin: 20px;
}
.margin-g-lg {
    margin: 30px;
}

.margin-l {
    margin-left: 15px;
}
.margin-l-sm {
    margin-left: 10px;
}
.margin-l-md {
    margin-left: 20px;
}
.margin-l-lg {
    margin-left: 30px;
}

.margin-r {
    margin-right: 15px;
}
.margin-r-sm {
    margin-right: 10px;
}
.margin-r-md {
    margin-right: 20px;
}
.margin-r-lg {
    margin-right: 30px;
}

.margin-t {
    margin-top: 15px;
}
.margin-t-sm {
    margin-top: 10px;
}
.margin-t-md {
    margin-top: 20px;
}
.margin-t-lg {
    margin-top: 30px;
}

.margin-b {
    margin-bottom: 15px;
}
.margin-b-sm {
    margin-bottom: 10px;
}
.margin-b-md {
    margin-bottom: 20px;
}
.margin-b-lg {
    margin-bottom: 30px;
}

/* Bootstrap Form Control Extension */

.form-control,
.border-line {
    background-color: #5f5f5f;
    background-image: none;
    border: 1px solid #424242;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
}
.form-control:focus,
.border-line:focus {
    border-color: #FFEB3B;
    background-color: #616161;
    color: #e6e6e6;
}
.form-control,
.form-control:focus {
    box-shadow: none;
}
.form-control::-webkit-input-placeholder { color: #BDBDBD; }

/* Container */

.container-content {
    background-color: #3a3a3aa2;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #FFEB3B;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
}

/* Backgrounds */

.main-bg {

    background: #424242;
    background: linear-gradient( #424242, #212121);
}

/* Login & Register Pages*/

.login-container {
    max-width: 400px;
    z-index: 100;
    margin: 0 auto;
    padding-top: 100px;
}
.login.login-container {
    width: 300px;
}
.wrapper.login-container {
    margin-top: 140px;
}
.logo-badge {
    color: #e6e6e6;
    font-size: 80px;
    font-weight: 800;
    letter-spacing: -10px;
    margin-bottom: 0;
}
		</style>
</head>
<body class="main-bg">
        <div class="login-container text-c animated flipInX">
                <div>
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                    <h3 class="text-whitesmoke">Forgot Password</h3>
                    
                <div class="container-content">
                    <form action="" method="POST" class="margin-t">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="">
                        </div>
                        
                        <button type="submit" name="submit" class="form-button button-l margin-b">Send Reset Link</button>
        
                        <a class="text-darkyellow" href="../login/"><small>Go Back</small></a>
                    </form>
                    <p class="margin-t text-whitesmoke"><small> Tawasul &copy; 2023</small> </p>
                </div>
            </div>
</body>
</html>