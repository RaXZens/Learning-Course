<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="main.css">
  <style type="text/css">

  </style>

</head>

<body>
  <nav>
    <div class="container">
      <header>
        <div
          class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <div class="col-md-3 mb-2 mb-md-0">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
              <div class="img"><img src="image/image1.jpg" width="110" height="50"></div>
            </a>
          </div>

          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php" class="nav-link px-9 link-dark link-hover-success">หน้าแรก</a></li>
            <li><a href="form.php" class="nav-link px-3 link-dark">คอร์สเรียน</a></li>
          </ul>

          <div class="col-md-5 text-end">
            <a href="login.php" class="btn btn-outline-dark me-2" role="button">เข้าสู่ระบบ</a>
            <a href="register.php" class="btn btn-warning" role="button">สมัครสมาชิก</a>
          </div>
      </header>
    </div>
  </nav>
  <div class="container">
    <div class="card-site shadow-lg m-5 p-5 text-center rounded-4">
      <h2>สมัครสมาชิก</h2>
      <form action="register_db.php" method="post">
        <div class="row ms-3 ">
        <?php if (isset($_SESSION['error'])) : ?>
          <div class="card shadow-sm m-2 p-2 text-center border border-danger-subtle text-danger mx-auto"style=" width: 70%;">
            <h3>
              <?php echo $_SESSION['error'];
              unset($_SESSION['error']);
              ?>
            </h3>
          </div>
        <?php endif; ?>
        <div class="col-sm-4 col-4 p-2 pt-3 text-md-end">
          <label for="username">ชื่อผู้ใช้</label>
        </div>
        <div class="col-lg-5 col-6 p-2 text-md-end">
          <input type="text" name="username" required class="form-control">
        </div>
        <div class="col-sm-4 p-2 col-4 pt-3 text-md-end">
          <label for="email">อีเมล</label>
        </div>
        <div class="col-lg-5 p-2 col-6 text-md-end">
          <input type="email" name="email" required class="form-control">
        </div>
        <div class="col-sm-4 p-2 pt-3 col-4 text-md-end">
          <label for="password_1">รหัสผ่าน</label>
        </div>
        <div class="col-lg-5 p-2 col-6 text-end">
          <input type="password" name="password_1" required class="form-control">
        </div>
        <div class="col-sm-5 p-2 col-lg-4 pt-3 col-5 text-end">
          <label for="password_2">ยืนยันรหัสผ่าน</label>
        </div>
        <div class="col-lg-5 p-2 col-5 text-end">
          <input type="password" name="password_2" required class="form-control">
        </div>
        <div class=" p-2 col-3 col-md-4 col-lg-5 pt-3 text-md-end">
          <input type="submit" name="Reg_Submit" value="ยืนยัน" class="btn btn-success ">
        </div>
        <div class=" p-2 pt-3  col-md-6 col-9 text-start">
          <p>เป็นสมาชิกอยู่แล้ว <a href="login.php" class="btn btn-warning">เข้าสู่ระบบ</a></p>
        </div>

    </div>
  </div>
  </form>
  </div>
        

</body>

</html>