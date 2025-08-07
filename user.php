<?php 
    session_start(); 
    include("connect.php");    
    if (!isset($_SESSION['username'])) {
      header("location: login.php");
      exit; 
  }?>
  <?php if (isset($_SESSION['username'])) {
  $Username = $_SESSION['username'];?>
      <?php
      } else {
     echo "กรุณาล็อกอินเพื่อเข้าถึงหน้านี้";
    header("Location: login.php");
                 exit;
                        }
                        ?>
     <?php 
  $conn = new mysqli($servername, $username, $password, $database);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT i_id, e_name, e_lastname, e_course, e_date, e_address, e_phone FROM education where username='$Username' AND e_status = 'completed'";
        $result = $conn->query($sql);
   if(mysqli_num_rows($result)>5){
            $rank='Silver';
        } else { $rank= 'Bronze';}
         $update_sql = "UPDATE education SET rank = '$rank' WHERE username='$Username'";
         $result_role=$conn->query($update_sql);
         $_SESSION['rank'] = $rank;

         
    ?>
    <?php if (isset($_SESSION['rank']))
      $rank=$_SESSION['rank'];
       ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="main.css">


</head>


<body>
    <!-- back to top -->
    <div class="bottom">
        <bottom type="bottom" class="btn btn-lg btn-success position-fixed bottom-0 end-0 translate-middle rounded-circle" onclick="scrollToTop()" id="back-to-up">
          Up
        </bottom>
    </div>


    <!-- back to top -->

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg mb-4 sticky-top">
        <div class="container ">
            <a href="user.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <div class="img"><img src="image/image1.jpg" width="110" height="50"></div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-auto"> <!-- Add ms-auto and me-auto to center the items -->
                    <li class="nav-item">
                        <a class="nav-link active px-3" aria-current="page" href="user.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="form.php">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3"   href="list_data.php">ประวัติการลงทะเบียนทั้งหมด</a>
                    </li>
                </ul>
                <div class="btn btn-warning nav-item dropdown">
                    <div class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item ">
                            <?php if (isset($_SESSION['username'])) {
                                $Username = $_SESSION['username'];
                                echo "User : " . $Username;
                            } else {
                                echo "กรุณาล็อกอินเพื่อเข้าถึงหน้านี้";
                                // หรือเปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
                                header("Location: login.php");
                                exit;
                            }
                            ?>

                            <a class="dropdown-item ">
                                <?php if (isset($_SESSION['rank']))
                                    $rank = $_SESSION['rank'];
                                echo 'Member : ' . $rank;
                                ?>
                            </a>

                            <hr />

                            <a class="dropdown-item ps-3" href="logout.php">
                                ออกจากระบบ</a>
                        </a>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
                    



   <!-- slider banner -->
   <div class="slideshow-container col-md-10 col-sm-10 col-10 ">
    <div class="myslide">
      <div class="img">
        <img src="image/brand1.png" width="1000" height="400">
      </div>
    </div>
    <div class="myslide">
      <div class="img">
        <img src="image/brand2.jpg" width="1000" height="400">
      </div>
    </div>
    <div class="myslide">
      <div class="img">
        <img src="image/brand1.png" width="1000" height="400">
      </div>
    </div>
    <div class="myslide">
      <div class="img">
        <img src="image/brand2.jpg" width="1000" height="400">
      </div>
    </div>
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">></a>
  </div>
  <br>
  <div class="dots" style="text-align: center;">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>

  </div>

<!-- card slider -->
  

  <!-- tag ตรงสินค้า -->
   <br>
  <div class="thingstag">
    <h2>คอร์สเรียนพิเศษ</h2>
  </div>

<!-- cards -->
  <section id="gallery">
    <div class="container">
      <div class="row">
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card shadow-lg mb-5 bg-body rounded">
            <img
              src="image/music.jfif"width="100" height="200"
              alt="" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title text-center">ดนตรี</h5>
              <p class="card-text text-center">1,700 ฿</p>
                <div class="bottom">
                  <a href="education-music.php" class="d-flex align-items-center justify-content-center  btn btn-outline-success btn-sm my-6">สนใจ</a>      
                </div>        
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card shadow-lg mb-5 bg-body rounded">
            <img
              src="image/Artop.jpg"width="100" height="200"
              alt="" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title text-center">ศิลปะ</h5>
              <p class="card-text text-center">1,400 ฿</p>
              <a href="education-arts.php" class="d-flex align-items-center justify-content-center  btn btn-outline-success btn-sm my-6">สนใจ</a>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card shadow-lg mb-5 bg-body rounded">
            <img
              src="image/Engx2.jfif"width="100" height="200"
              alt="" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title text-center">ภาษา</h5>
              <p class="card-text text-center">1,200 ฿</p>
              <a href="education-lang.php" class="d-flex align-items-center justify-content-center  btn btn-outline-success btn-sm my-6">สนใจ</a>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card shadow-lg mb-5 bg-body rounded">
            <img
              src="image/Mart11123.jfif"width="100" height="200"
              alt="" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title text-center">คณิตศาสตร์</h5>
              <p class="card-text text-center">1,200 ฿</p>
              <a href="education-math.php" class="d-flex align-items-center justify-content-center  btn btn-outline-success btn-sm my-6">สนใจ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- cards -->
  <!-- footer -->
<footer class="site-footer my-4 bg-warning mb-0">
    <div class="container mt-3">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6><strong>สามรถติดต่อ-สอบถามได้ที่</strong></h6>
          <p class="text-justify">DAY ONE Learning and Beyond ศูนย์การเรียนรู้เพื่อเสริมสร้างพัฒนาการ ภูเก็ต
            <a href="https://www.facebook.com/dayonemusicphuket">https://www.facebook.com/dayonemusicphuket</a>
          </p>
        </div>

        <div class="col-xs-6 col-md-3">

          <ul class="footer-links">

          </ul>
        </div>

        <div class="col-xs-6 col-md-3">
          <h5 style="color: #FFFFFF;"><strong>ที่อยู่ DAY ONE Learning and Beyond</strong></h5>
          <p>402 ตำบล ศรีสุนทร อำเภอถลาง ภูเก็ต 83110</p>
          <ul class="footer-links">
            <li><a href="https://maps.app.goo.gl/7zbN6VpyfsmTJwGP6">link map</a></li>

          </ul>
        </div>
      </div>
      <hr> 
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2017 All Rights Reserved by
            <a href="#">Scanfcode</a>.
          </p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>




    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>