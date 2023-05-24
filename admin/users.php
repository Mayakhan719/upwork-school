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
        .user-initial {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: #14a800;
  color: #fff;
  font-size: 24px;
  font-weight: bold;
  text-align: center;
  line-height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.confirm-button-class {
  background-color: #14a800 !important;
  color: #14a800 !important;
  border: 1px solid #14a800 !important;
}
.title-class {
  font-size: 15px !important;
}
.icon-class {
  font-size: 10px !important;
}
.confirm-button-class .swal2-icon svg {
  width: 12px !important;
  height: 12px !important;
}
.swal2-actions .swal2-confirm {
  background-color: #14a800 !important;
  color: white !important;
  border: none !important;
  box-shadow: none !important;
}
.swal2-actions .swal2-cancel {
  background-color: #fff !important;
  color: #14a800 !important;
  border: 1px solid #14a800 !important;
  box-shadow: none !important;
}
.swal2-confirm:focus, .swal2-cancel:focus {
  box-shadow: none !important;
  border: 1px solid #14a800;
}
.swal2-actions button:hover {
  border: none !important;
}
#overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9998;
  display: none;
}
#loader {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
  display: none;
}

.spinner {
  border: 3px solid #14a800;
  border-top: 3px solid #f3f3f3;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.form-switch input:checked {
  background-color: #14a800;
  border: #14a800;
}

.form-switch input:checked + label::before {
  transform: translateX(20px); /* Move the toggle button to the right when checked */
}
.modal-backdrop {
  background-color: rgba(0, 0, 0, 0.5);
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
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1" href="index.php"><img style="height: 50px;" src="assets/image/logo.png" alt="logo"></a>
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
              <a class="nav-link active" href="users.php">
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
      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 mt-3 mb-5">
      <div id="loader">
          <div class="spinner"></div>
        </div>
        <div id="overlay"></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h1 style="color: #14a800;" class="h2">Users</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            <!-- Example single danger button -->
<div class="btn-group">
  
</div>
            <div class="row">
              <?php 
              
include_once("../include/db.php");
$conn=connect();
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$run = pg_query($conn,$sql);
$count = 1;
while($result = pg_fetch_assoc($run)){
    $id = $result["id"];
    $Username = $result["username"];
    $email = $result["email"];
    $status = $result["status"];
$firstLetter = substr($Username, 0, 1); // "H"
?>
              <div class="col-md-3 mt-3">
                <div class="card" style="width: 300px;">
                <div class="row">
                  <div class="col-6">
                    <?php if ($status == 'block') {
                      ?>
                    <div><i class="text-danger fa-solid fa-ban"></i></div>
                    <?php 
                    }
                    ?>
                  </div>
                  <div class="col-6 text-end">
                  <a class=" mx-2 mt-2 mb-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
                <ul class="dropdown-menu">
                      <?php 
                      if ($status == 'unblock' || $status == '') {
                        ?>
                        <li><div class="form-check form-switch mx-2">
                            <input style="box-shadow:none" onchange="confirmation(<?php echo $id?>)" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Block</label>
                          </div>
                        </li>
                      <?php
                  }else{
                      ?>
                        <li><div class="form-check form-switch mx-2">
                            <input style="box-shadow:none" onchange="Active(<?php echo $id?>)" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Unblock</label>
                          </div>
                        </li>
                      <?php
                  }
                  ?>
                </ul>
                  </div>
                </div>
                
                    <a style="text-decoration:none" onclick="view(<?php echo $id?>)" data-bs-toggle="modal" data-bs-target="#Modaledit" href=""><div style="margin-left:120px;" class="user-initial text-uppercase text-center"><?php echo $firstLetter?></div></a>
                    <div class="card-body">
                    <a style="text-decoration:none" data-bs-toggle="modal" onclick="view(<?php echo $id?>)" data-bs-target="#Modaledit" href=""><h5 style="color:#14a800" class="card-title text-center"><?php echo $Username?></h5></a>
                    <a style="text-decoration:none;color:black" data-bs-toggle="modal" onclick="view(<?php echo $id?>)" data-bs-target="#Modaledit" href=""><h6 class="card-text text-center"><?php echo $email?></h6></a>
                    </div>
                  </div>
              </div>
              <?php
}
?>
            </div>
          </div>
          
      </div>
<!-- Modal -->
<div class="modal fade" id="Modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">User Detail</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mb-5">
        <div class="row ">
          <div class="col-md-12 justify-content-center d-flex">
            <div class="user-initial text-uppercase mt-3 mb-3"><?php echo $firstLetter?></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6">
              <h5 style="color:#14a800" class="card-title mx-2 mt-4">Username</h5>
          </div>
          <div class="col-md-6 col-sm-6">
            <h6 class="card-text mt-4" id="username4"></h6></h6>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6">
              <h5 style="color:#14a800" class="card-title mx-2 mt-4">Email</h5>
          </div>
          <div class="col-md-6 col-sm-6">
            <h6 class="card-text mt-4" id="email4"></h6></h6>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6" >
              <h5 style="color:#14a800" class="card-title mx-2 mt-4">Status</h5>
          </div>
          <div class="col-md-6 col-sm-6">
            <h6 class="card-text mt-4" id="status4"></h6>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
    </main>
    </div>
    </div>
<?php include("include/scripts.php");?>
<script>
    function Active(id){
        console.log(id);
    var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        var raw = JSON.stringify({
          "id": id,
        });
        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
          };
          $('#overlay').show();
          $('#loader').show();
          fetch("backend/user/active-user.php", requestOptions)
          .then((response) => response.json())
          .then((data) => {
            if(data.status){
            window.location = 'users.php';
            }else{
                console.log(data.message);
            }
          })
          .catch((error) => {
            console.error('Error:', error);
          });
}
</script>
<script>
    function confirmation(id){
        console.log(id);
    var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        var raw = JSON.stringify({
          "id": id,
        });
        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
          };
          $('#loader').show();
            $('#overlay').show();
          fetch("backend/user/block-user.php", requestOptions)
          .then((response) => response.json())
          .then((data) => {
            if(data.status){
            window.location = 'users.php';
            }else{
                console.log(data.message);
            }
          })
          .catch((error) => {
            console.error('Error:', error);
          });

}
</script>

    <script>
            function view(id) {
        $.ajax({
            url: "backend/user/get-user-by-id.php",
            method: "POST",
            data: {id: id},
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $('#username4').html(response.username);
                $('#email4').html(response.email);
                $('#status4').html(response.status);
 // And finally you can this function to show the pop-up/dialog
 $("#exampleModal2").modal();
            }
        });
    }
  </script>
  <script>
  $(document).ajaxStart(function() {
  $('#overlay').show();
  $('#loader').show();
});

$(document).ajaxStop(function() {
  $('#loader').hide();
  $('#overlay').hide();
});
</script>
</body>
</html>