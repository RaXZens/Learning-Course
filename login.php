<?php include("connect.php");
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
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

          <div class="col-md-4 text-end">
            <a class="btn btn-outline-dark me-2" href="login.php" role="button">เข้าสู่ระบบ</a>
            <a class="btn btn-warning" href="register.php" role="button">สมัครสมาชิก</a>
          </div>
      </header>
    </div>
  </nav>
  <div class="d-flex justify-content-center ">
    <div class="login-form col-md-10 m-md-5 m-sm-5 col-lg-8 col-xl-6">
      <div class="card-site rounded-4 shadow-lg  m-3 m-md-5 p-3  text-center ">
        <h2>เข้าสู่ระบบ</h2>
        <form action="login_db.php" method="post">
          <div class="row ms-3 ">

            <?php if (isset($_SESSION['error'])) : ?>
              <div class="card shadow-sm m-2 col-sm-10 col-md-9 p-2 col-12 text-center border border-danger-subtle text-danger mx-auto">
                <h3>
                  <?php echo $_SESSION['error'];
                  unset($_SESSION['error']); ?>
                </h3>
              </div>
            <?php endif; ?>
            <div class="col-4  col-sm-4 col-md-4 ms-md-5 p-2 pt-3 text-end ">
              <label for="username">ชื่อผู้ใช้</label>
            </div>
            <div class="col-6 col-sm-6 col-md-4  p-2 ">
              <input type="text" name="username" required class="form-control">
            </div>


            <div class="col-4  col-sm-4 p-2 pt-3 ms-md-5 col-md-4 text-end">
              <label for="password">รหัสผ่าน</label>
            </div>
            <div class="col-6 col-sm-6 col-md-4  p-2 ">
              <input type="password" name="password" required class="form-control">
            </div>


            <div class="d-sm-flex  col-sm-12 col-12 mt-3 pe-2 text-end  ">
              <div class="mx-1 col-12 text-center text-sm-end col-sm-4 col-md-5 "><input type="submit" name="login_Submit" value="ยืนยัน" class="btn btn-warning "></div>
              <p class="text-center my-2 ">ยังไม่เป็นสมาชิก</p>
              <div class="mx-1 col-12 col-sm-3 text-sm-start text-center "><a href="register.php" class="btn btn-success">ลงทะเบียน</a></div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>


</html>