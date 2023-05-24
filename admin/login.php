<?php 
session_start();
if (isset($_SESSION["admin_email"]) && isset($_SESSION["admin_id"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upwork Mastery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/js/jquery-toast-plugin/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-auth">
    <div class="container">
        <div class="row justify-content-center mt-120">
            <div class="col-md-6">
                <div class="card auth-card">
                    <div class="card-body">
                        <div class="form-header">
                            <div class="logo text-center">
                                <img style="height:90px;" src="assets/image/logo.png" alt="logo">
                            </div>
                            <div class="heading-auth">
                                <h4 class="text-center mt-5 mb-3">Login Account</h4>
                                <p class="text-center mb-5">Login to get started</p>
                            </div>
                        </div>
                        <div class="form-body">
                            <form  action="backend/user/login.php" method="post">
                                <div class="mb-3">
                                  <input type="email" name="email" class="form-control" placeholder="Email Address" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" id="password-field" name="password" class="form-control" placeholder="Password" aria-label="Dollar amount (with dot and two decimal places)">
                                    <span class="input-group-text"><a href="#"><i id="toggle-password" class="fa-sharp fa-solid fa-eye"></i></a></span>
                                  </div>
                                <div class="forget-anchar mb-3 text-end">
                                    <a class="forget-password" href="forget-password.php">Forget Password?</a>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Sign in</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="assets/js/jquery-toast-plugin/dist/jquery.toast.min.js"></script>  
<script src="assets/js/app.js"></script>
<?php 
if (isset($_SESSION["message"])) {
	# code...
	?>
	<script>
$.toast({
            heading: 'Looks Good!',
            text: '<?php echo $_SESSION["message"]?>',
            position: 'top-right',
            loaderBg:'#878787',
            hideAfter: 5000
        });
	</script>
	<?php
	unset($_SESSION["message"]);
}

?>
		<?php 
if (isset($_SESSION["message_error"])) {
	# code...
	?>
	<script>
$.toast({
            heading: 'Opps! Failed',
            text: '<?php echo $_SESSION["message_error"]?>',
            position: 'top-right',
            loaderBg:'#0e7600',
            icon: 'error',
            hideAfter: 5000
        });
	</script>
	<?php
	unset($_SESSION["message_error"]);
}
?>
<script>
// Get the eye icons and password fields
const togglePassword1 = document.querySelector('#toggle-password');
const passwordField1 = document.querySelector('#password-field');
// Add click event listeners to the eye icons
togglePassword1.addEventListener('click', function() {
  const type = passwordField1.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField1.setAttribute('type', type);
  togglePassword1.classList.toggle('fa-eye-slash');
});

</script>
</body>

</html>