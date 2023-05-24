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
          .card{
            width: 100%;
          }
        }
      </style>
</head>
<body>
<?php include("include/header.php");?>
  <div class="container-fluid ">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse shadow">
        <div class="position-sticky">
          <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1" href="index.php"><img style="height: 50px;" src="assets/image/logo.png" alt="logo"></a>
          <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Menu</span>
                <a class="link-secondary" href="#" aria-label="Add a new report"></a>
              </h6>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
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
      
      <?php
include_once("../include/db.php");
$conn=connect();
$sql = "SELECT * FROM users";
$run = pg_query($conn,$sql);
$users = pg_num_rows($run);
$sql2 = "SELECT * FROM subscriptions";
$run2 = pg_query($conn,$sql2);
$subscriptions = pg_num_rows($run2);
// total video
$sql3 = "SELECT * FROM videos";
$run3 = pg_query($conn,$sql3);
$video = pg_num_rows($run3);
?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3 mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h1 style="color: #14a800;" class="h2">Dashboard</h1>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6 px-md-6 mt-2">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="title"><h3>Total Users</h3></div>
                  </div>
                  <div class="card-icon col-3">
                    <img src="assets/image/Group 3156.png" alt="icon">
                  </div>
                  <div class="totals">
                    <h4><?php echo $users?></h4>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-6 col-lg-6 px-md-6 mt-2">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="title"><h3>Total Videos</h3></div>
                  </div>
                  <div class="card-icon col-3">
                    <img src="assets/image/Group 3161.png" alt="icon">
                  </div>
                  <div class="totals">
                  <h4><?php echo $video?></h4>
                  </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <h4>Course Video</h4>
        </div>
        <div class="row">
          <div class="col-md-7 col-sm-12">
            <div class="row">
              <?php
            $sql = "SELECT * FROM videos ORDER BY created_at DESC";
            $run = pg_query($conn,$sql);
            while($result = pg_fetch_assoc($run)){
                $id = $result["id"];
                $title = $result["title"];
                $link = $result["link"];
                $description = $result["description"];
            parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
?>
              <div class="col-md-4 mt-3 col-sm-12">
                <div class="card" style="width: 16rem;">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $my_array_of_vars['v']?>" id="video" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  <!-- <a href="videos.php"><img src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']?>/0.jpg" class="card-img-top" alt="thumbnail"></a> -->
                  <div class="card-body" style="height:120px">
                  <a style="text-decoration:none;" href="videos.php"><h6 style="color:#14a800" class="card-title"><?php echo $title?></h6></a>
                    <?php

$words = explode(" ", $description);
if (count($words) > 10) {
  $description = implode(" ", array_slice($words, 0, 10)) . "...";
?>
                    <a style="text-decoration:none" href="videos.php"><p style="color:black" id="description" class="card-text"><?php echo $description?></p></a>
<?php
}else {
  ?>
                    <a style="text-decoration:none" href="videos.php"><p style="color:black" id="description" class="card-text"><?php echo $description?></p></a>
  <?php
}
?>
                  </div>
                </div>
              </div>

              <?php 

            }
            ?>
            </div>
          </div>
          <?php
  $time = strtotime(date(("Y-m-d")));
$now = date("M-Y", strtotime("0 day", $time));
$next = date("M-Y", strtotime("+1 month", $time));
$oneMonth = date("M-Y", strtotime("-1 month", $time));
$twoMonth = date("M-Y", strtotime("-2 month", $time));
$thrMonth = date("M-Y", strtotime("-3 month", $time));
$fouMonth = date("M-Y", strtotime("-4 month", $time));
$fivMonth = date("M-Y", strtotime("-5 month", $time));
$sixMonth = date("M-Y", strtotime("-6 month", $time));
$sevMonth = date("M-Y", strtotime("-7 month", $time));
$eigMonth = date("M-Y", strtotime("-8 month", $time));
$ninMonth = date("M-Y", strtotime("-9 month", $time));
$tenMonth = date("M-Y", strtotime("-10 month", $time));
$eleMonth = date("M-Y", strtotime("-11 month", $time));
$one = 0;
$two = 0;
$three = 0;
$four = 0;
$five = 0;
$six = 0;
$seven = 0;
$eight = 0;
$nine = 0;
$ten = 0;
$eleven = 0;
$twl = 0;
  $current_month = 
$sql = "SELECT * FROM users";
$run = pg_query($conn,$sql);
while($users = pg_fetch_assoc($run)){
  $created_at = $users["created_at"];
  $end_time4 = date("M-Y", strtotime($created_at));

  if ($created_at == $now) {
    $one++;
  }elseif ($created_at == $twoMonth) {
    $two++;
  }elseif ($created_at == $thrMonth) {
    $three++;
  }elseif ($created_at == $fouMonth) {
    $four++;
  }elseif ($created_at == $fivMonth) {
    $five++;
  }elseif ($created_at == $sixMonth) {
    $six++;
  }elseif ($created_at == $sevMonth) {
    $seven++;
  }elseif ($created_at == $eigMonth) {
    $eight++;
  }elseif ($created_at == $ninMonth) {
    $nine++;
  }elseif ($created_at == $tenMonth) {
    $ten++;
  }elseif ($created_at == $eleMonth) {
    $eleven++;
  }else {
    $twl++;
  }
}

  ?>
          <div class="col-md-5 mt-3">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                  <h5>Users</h5>
                  </div>
                  <div class="col-4 ms-auto">
                  <div class="btn-toolbar mb-2 mb-md-0 justify-content-end">
                  <select onchange="dayFilter(this.value)" class="form-select" aria-label="Default select example">
                    <option value="year">By Years</option>
                      <option selected value="month">By months</option>
                      <option value="weeks">By Weeks</option>
                      <!-- <option value="days">By Days</option>  -->
                    </select>
                </div>
                  </div>
                </div>
                <canvas class="my-4  w-100" id="myChart" width="500px" height="240"></canvas>
              </div>
            </div>
          </div>
      </div>
      </main>  
    </div>
    </div>
    <?php include("include/scripts.php");?>
<script>
		function dayFilter(data) {
				$.ajax({
					url: "backend/user/filter.php",
					type: "POST",
					data: { data: data },
					success: function(response) {
            console.log(response);
            var ctx2 = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    var myChart2 = new Chart(ctx2, {
      type: 'line',
      data: {
        labels: response.days,
        datasets: [{
          data: response.data,
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#19af04',
          borderWidth: 4,
          pointBackgroundColor: '#19af04'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
          }
				});
      }
	</script>
<script>
   var ctx2 = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    var myChart2 = new Chart(ctx2, {
      type: 'line',
      data: {
        labels: [
          '<?php echo $eleMonth?>',
          '<?php echo $tenMonth?>',
          '<?php echo $ninMonth?>',
          '<?php echo $eigMonth?>',
          '<?php echo $sevMonth?>',
          '<?php echo $sixMonth?>',
          '<?php echo $fivMonth?>',
          '<?php echo $fouMonth?>',
          '<?php echo $thrMonth?>',
          '<?php echo $twoMonth?>',
          '<?php echo $oneMonth?>',
          '<?php echo $now?>',
        ],
        datasets: [{
          data: [
            <?php echo $one?>,
            <?php echo $two?>,
            <?php echo $three?>,
            <?php echo $four?>,
            <?php echo $five?>,
            <?php echo $six?>,
            <?php echo $seven?>,
            <?php echo $eight?>,
            <?php echo $nine?>,
            <?php echo $ten?>,
            <?php echo $eleven?>,
            <?php echo $twl?>
          ],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#19af04',
          borderWidth: 4,
          pointBackgroundColor: '#19af04'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
</script>
</body>
</html>