<?php 
session_start();
if (!isset($_SESSION["admin_email"]) && !isset($_SESSION["admin_id"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/links.php");?>
    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
<?php include("include/header.php");?>
  <div class="container-fluid ">
    <div class="row mt-120">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse shadow">
        <div class="position-sticky">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1" href="#"><img style="height: 50px;" src="assets/image/logo.png" alt="logo"></a>
          <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Menu</span>
                <a class="link-secondary" href="#" aria-label="Add a new report"></a>
              </h6>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="videos.php">
                <span data-feather="video"></span>
                Videos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="privacy.php">
                <span data-feather="lock"></span>
                Privacy Policy
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="terms-and-conditions.php">
                <span data-feather="folder"></span>
                Terms & Conditions
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Licence.php">
                <span data-feather="file"></span>
                License Agreement
              </a>
            </li>
            
          </ul>
        </div>
      </nav>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row">
            <div class="col-6">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 style="color:#14a800" class="h2">Profile</h1>
              </div>
          </div>
          <div class="col-6">
          <div class="row">
            <div class="col-lg-12 pt-4 mb-3 d-flex justify-content-end">
                <button class="border-0 fw-600 btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#Modaledit">Update Password</button>
            </div>
        </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-body">
                      <?php 
include_once("../include/db.php");
$conn=connect();
$sql = "SELECT * FROM admin";
$run = pg_query($conn,$sql);
$count = 1;
$result = pg_fetch_assoc($run);
    $Username = $result["nameuser"];
    $email = $result["email"];
    $dob = $result["dob"];
    $gender = $result["gender"];

?>
                        <form action="backend/user/updateprofile.php" method="post">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <input name="email" value="<?php echo $email?>" type="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <input name="username" value="<?php echo $Username?>" type="text" placeholder="Username" class="form-control"  id="exampleInputPassword1">
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <input name="dob" value="<?php echo $dob?>" type="date" placeholder="Date Of Birth" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <select name="gender" class="form-select" aria-label="Default select example">
                                    <?php
                                    if ($gender == 'male') {?>
<option selected>Select Gender</option>
                                        <option selected value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                        <?php
                                    }elseif ($gender == 'female') {
                                      ?>
                                      <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option selected value="female">Female</option>
                                        <option value="other">Other</option>
                                        <?php
                                    }else {
                                      ?>
                                      <option selected>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option selected value="other">Other</option>
                                        <?php
                                    }?>
                                      
                                    
                                    
                                      </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="mb-5">
                                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
<div class="modal fade" id="Modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Password</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/user/change-password.php" method="post">
      <div class="modal-body p-3">
        <div class="input-group mb-3">
          <input style="box-shadow: none;" id="password-field" name="password" type="password" class="form-control" placeholder="Old Password">
          <span  class="input-group-text"><a href="#"><i id="toggle-password" style="color:#969AA8" class="fa-sharp fa-solid fa-eye"></i></a></span>
        </div>

        <div class="input-group mb-3">
          <input style="box-shadow: none;" id="password-field2" type="password" name="new-password" class="form-control" placeholder="New password">
          <span  class="input-group-text"><a href="#"><i id="toggle-password2" style="color:#969AA8" class="fa-sharp fa-solid fa-eye"></i></a></span>
        </div>
        <div class="input-group mb-3">
          <input style="box-shadow: none;" id="password-field3" type="password" name="confirm-password" class="form-control" placeholder="New password">
          <span  class="input-group-text"><a href="#"><i id="toggle-password3" style="color:#969AA8" class="fa-sharp fa-solid fa-eye"></i></a></span>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center mt-3">
        <button style="padding:7px 200px;" type="submit" class="btn btn-primary ">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
    </main>
    </div>
    </div>
    <?php include("include/scripts.php");?>
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

const togglePassword2 = document.querySelector('#toggle-password2');
const passwordField2 = document.querySelector('#password-field2');

const togglePassword3 = document.querySelector('#toggle-password3');
const passwordField3 = document.querySelector('#password-field3');

// Add click event listeners to the eye icons
togglePassword1.addEventListener('click', function() {
  const type = passwordField1.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField1.setAttribute('type', type);
  togglePassword1.classList.toggle('fa-eye-slash');
});

togglePassword2.addEventListener('click', function() {
  const type = passwordField2.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField2.setAttribute('type', type);
  togglePassword2.classList.toggle('fa-eye-slash');
});

togglePassword3.addEventListener('click', function() {
  const type = passwordField3.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField3.setAttribute('type', type);
  togglePassword3.classList.toggle('fa-eye-slash');
});

</script>

</body>
</html>