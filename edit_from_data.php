<?php include("connect.php");
session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.php");
  exit;
} ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>บันทึก ข้อมูลสินค้า</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="main.css">
  <style type="text/css">
    body {

      background-color: white;
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg mb-4 sticky-top">
    <div class="container">
      <a href="user.php" class="d-inline-flex link-body-emphasis text-decoration-none">
        <div class="img"><img src="image/image1.jpg" width="110" height="50"></div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto me-auto"> <!-- Add ms-auto and me-auto to center the items -->
          <li class="nav-item">
            <a class="nav-link  px-3" aria-current="page" href="user.php">หน้าแรก</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-3" href="form.php">คอร์สเรียน</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active px-3" href="list_data.php">ประวัติการลงทะเบียนทั้งหมด</a>
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

  <?php
  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $i_id = $_GET['i_id'];

  $sql = "SELECT * FROM education WHERE i_id='$i_id'";
  // รับค่า
  // SQL ลบข้อมูลทีละ record ตามเงื่อนไข


  $result = $conn->query($sql);
  $rs = mysqli_fetch_assoc($result);
  ?>
  <div class="container  mt-1 pt-1 lg-m-5 lg-p-5 mx-auto">
    <div class="card shadow-lg m-5 p-5 ">
      <h1 class="text-center">รายละเอียดการจอง</h1>
      <form method="post" action="edit_data.php">
        <div class="d-flex flex-column flex-lg-row justify-content-center mt-3  " style="gap: 12.5rem;">
          <div class="ms-5">
            <div class="d-flex p-2 gap-3 fs-6">
              <div class="d-flex">
                <div class="fw-bold">ชื่อ :</div>
                <div class="fw-light ms-2"><?php echo $rs['e_name']; ?></div>
              </div>
              <div class="d-flex">
                <div class="fw-bold">
                  นามสกุล : </div>
                <div class="fw-light ms-2"><?php echo $rs['e_lastname']; ?></div>
              </div>
            </div>
            <div class="d-flex p-2  mt-2">
              <div class="fw-bold">
                คอร์สทีสนใจ : </div>
              <div class="fw-light ms-2"><?php echo $rs['e_course']; ?></div>
            </div>
            <div class="d-flex p-2 mt-2">
              <div class="fw-bold">
                เวลาที่ต้องการจอง : </div>
              <div class="fw-light ms-2"><?php echo $rs['e_date']; ?></div>
            </div>
            <div class="d-flex p-2  mt-2">
              <div class="fw-bold">
                ที่อยู่ : </div>
              <div class="fw-light ms-2"><?php echo $rs['e_address']; ?></div>
            </div>
            <div class="d-flex p-2  mt-2">
              <div class="fw-bold ">
                โทรศัพท์ : </div>
              <div class="fw-light ms-2"><?php echo $rs['e_phone']; ?></div>
            </div>
            <input type="hidden" name="i_id" value="<?php echo $rs['i_id']; ?>">

            <div class="mt-5 ">
              <input type="submit" name="submit" value="ยืนยัน" class="btn btn-success">
              <a href="list_data.php" class="btn btn-secondary">ย้อนกลับ</a>
            </div>
          </div>


          <div class="">
            <h3 class="text-center">ชำระเงิน QrCode </h3>
            <img src="image/test qr.jpg" width="200" height="200">
            <p class="mt-2">เลขบัญชี : </p>
            <p>โทรศัพท์ : </p>
          </div>
        </div>

      </form>
      <?php


      $conn->close();
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>