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
.rectangle {
  height: 100%;
  width: 100%;
  border-radius:7px;
  border: 1px solid #969AA8;
  vertical-align:middle;
  justify-content:center;
  align-items: center;
  padding: 10px;
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
  transition: 0.5s;
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
.modal-backdrop {
  background-color: rgba(0, 0, 0, 0.5);
}
      </style>
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
              <a class="nav-link" href="index.php">
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
              <a class="nav-link active" aria-current="page" href="#">
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
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3 mb-5">
      <div id="loader">
          <div class="spinner"></div>
        </div>
        <div id="overlay"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 style="color: #14a800;" class="h2">Terms And Conditions</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-lg-12 pt-4 mb-3 d-flex justify-content-end">
                    <button style="  border-radius: 30px;
  background-color:var(--primary);
  border:none;
  font-weight: 500;
  outline: none;
  font-size: 15px;
  padding:7px 30px;
  transition: 0.5s;" href="#" onclick="loadEdit3()" class="border-0 fw-600 btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            </div>
        </div>
        <?php
include_once("../include/db.php");
$conn=connect();
$sql = "SELECT * FROM terms_conditions ORDER BY status ASC";
$run = pg_query($conn,$sql);
while($result = pg_fetch_assoc($run)){

if (!empty($result["terms_and_condition"])) {
    $id = $result["id"];
    $terms_and_condition = $result["terms_and_condition"];
    $created_at = $result["created_at"];
    $status =$result["status"];
    $end_time4 = date("d-M Y", strtotime($created_at));
}else {
    $terms_and_condition = '';
}
if ($status == 'active') {
?>
      <div class="row mt-4">
        <div class="col-md-8">
            <div class="header">
                <h4>Active Terms And Conditions</h4>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-end">
            <div class="tag">
              <h5><span style="background:#14a800; border-radius:10px" class="badge">active</span></h5>
            </div>
            <div class="icon-b">
            <a class=" mx-2 mt-2 mb-2 mx-3" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="loadEdit(<?php echo $id?>)" data-bs-toggle="modal" data-bs-target="#Modaledit" href="#"><i class="text-primary fa-solid fa-pen-to-square"></i> Update</a></li>
                    <li><a class="dropdown-item" onclick="confirmation(<?php echo $id?>)" href="#"><i class="text-danger fa-solid fa-trash"></i> Delete</a></li>
                </ul>
            </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
            <div class="rectangle"> 
                <?php echo $terms_and_condition?>
            </div>
        </div>
      </div>
      <?php
}else {
    ?>
<div class="row mt-4">
        <div class="col-md-8">
            <div class="header">
                <h4>Last Updated <span style="font-size:15px;">(<?php echo $end_time4?>)</span></h4>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-end">
            <div class="tag">
            <h5><span style="border-radius:10px" class="badge bg-secondary">inactive</span></h5>
            </div>
            <div class="icon-b">
            <a class=" mx-2 mt-2 mb-2 mx-3" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="loadEdit(<?php echo $id?>)" data-bs-toggle="modal" data-bs-target="#Modaledit" href="#"><i class="text-primary fa-solid fa-pen-to-square"></i> Update</a></li>
                    <li><a class="dropdown-item" onclick="confirmation(<?php echo $id?>)" href="#"><i class="text-danger fa-solid fa-trash"></i> Delete</a></li>
                </ul>
            </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
            <div class="rectangle"> 
                <?php echo $terms_and_condition?>
            </div>
        </div>
      </div>
    <?php
}
}
?>
      
    </main>  
    <!-- Modal -->
<div class="modal fade" id="Modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Terms And Conditions</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/user/update-terms_and_condition.php" method="post">
      <div class="modal-body">
        <div class="input-group mb-3">
            <select name="status" style="box-shadow: none;" class="form-select" aria-label="Default select example">
                <option value="inactive">Inactive</option>
                <option value="active">Active</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <textarea id="termscondition" name="terms_and_condition"></textarea>
        </div>
        <div class="input-group mb-3">
            <input style="box-shadow: none;"  type="hidden" id="id" name="id" class="form-control" placeholder="Link Of Youtube">
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center mt-3">
        <button style="  border-radius: 30px;
  background-color:var(--primary);
  border:none;
  font-weight: 500;
  outline: none;
  font-size: 15px;
  padding:7px 30px;
  transition: 0.5s;" type="submit" class="btn btn-primary">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Terms And Conditions</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/user/terms_and_condition.php" method="post">
      <div class="modal-body">
      <div class="input-group mb-3">
            <select name="status" style="box-shadow: none;" class="form-select" aria-label="Default select example">
                <option value="inactive">Inactive</option>
                <option value="active">Active</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <textarea name="terms_and_condition"></textarea>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center mt-3">
        <button style="  border-radius: 30px;
  background-color:var(--primary);
  border:none;
  font-weight: 500;
  outline: none;
  font-size: 15px;
  padding:7px 30px;
  transition: 0.5s;" type="submit" class="btn btn-primary ">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php include("include/scripts.php")?>
<script src="assets/js/jquery-toast-plugin/dist/jquery.toast.min.js"></script> 
<script src="https://cdn.tiny.cloud/1/yo9e1ts5xtf3knyjm2uck5okrzzgtapaef9txyy5qk62bfyp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    function loadEdit3(){
        tinymce.init({
      selector: 'textarea',
      height:900,
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
    }
  </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
  <script>
    function confirmation(id){
        console.log(id);
        Swal.fire({
  title: 'Confirmation',
  text: "Do you want to delete!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete'
}).then((result) => {
  if (result.isConfirmed) {
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
          fetch("backend/user/delete-terms.php", requestOptions)
          .then((response) => response.json())
          .then((data) => {
            if(data.status){
            window.location = 'terms-and-conditions.php';
            }else{
                console.log(data.message);
            }
          })
          .catch((error) => {
            console.error('Error:', error);
          });
  }
})
}
</script>
<script>
    function loadEdit(id) {
        $.ajax({
            url: "backend/user/get-terms-by-id.php",
            method: "POST",
            data: {id: id},
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $('#termscondition').val(response.terms_and_condition);
                $('#id').val(response.id);
                tinymce.init({
      selector: 'textarea',
      height:900,
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
 // And finally you can this function to show the pop-up/dialog
 $("#Modaledit").modal();
            }
        });
    }
  </script>
   <?php 
if (isset($_SESSION["message"])) {
	# code...
	?>
	<script>
$.toast({
            heading: 'Looks Good!',
            text: '<?php echo $_SESSION["message"]?>',
            position: 'top-right',
            loaderBg:'#14a800',
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