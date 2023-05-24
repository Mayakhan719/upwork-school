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
    <link rel="stylesheet" href="assets/js/jquery-toast-plugin/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
                                <h4 class="text-center mt-5 mb-3">Forget Password</h4>
                                <p class="text-center mb-5">Enter email for a verification code</p>
                            </div>
                        </div>
                        <div class="form-body">
                            <form action="backend/user/forgot-password.php" method="post">
                                <div class="mb-3">
                                  <input type="email" name="email" class="form-control" placeholder="Email Address" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Send Code</button>
                                <div class="forget-anchar mt-3 text-end">
                                    <a class="forget-password" href="login.php">Back To Login</a>
                                </div>
                                
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="assets/js/jquery-toast-plugin/dist/jquery.toast.min.js"></script>  
<script src="assets/js/bootstrap.min.js"></script>
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
</body>
</html>