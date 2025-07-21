<?php include("connect.php"); 
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit; 
}?>
<!DOCTYPE html>
<html>

<head>
  <title>แบบฟอร์มการจอง</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <a class="nav-link active px-3" href="form.php">คอร์สเรียน</a>
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

  <div class="container m-5 p-5 mx-auto">
    <div class="card shadow-lg m-5 p-5 " style="text-align:center;">
      <strong> ฟอร์มบันทึกข้อมูล</strong><br>

      <form method="post" action="add_data.php">
        <div class="row ms-3">
          <div class="col-sm-3 p-2 text-start col-md-3 col-lg-4   text-md-end mt-2 col-5">
            ชื่อ :
          </div>
          <div class="col-sm-9 col-md-9 col-lg-6 p-2 ">
            <input name="name" type="text" size="50" required class="form-control">
          </div>
          <div class="col-sm-5 p-2 text-md-end col-md-4 col-lg-4 text-start mt-2 col-8">
            นามสกุล :
          </div>
          <div class="col-sm-7 col-md-8 col-lg-6 p-2 ">
            <input name="lastname" type="text" size="50" required class="form-control">
          </div>
          <div class="col-sm-6 p-2 col-md-4 text-start text-md-end mt-2 col-10">
            คอร์สทีสนใจ :
          </div>
          <div class="col-sm-6 col-md-8 col-lg-6 p-2 ">
          <select name="education" class="form-control">
        	    <option value="music">ดนตรี</option>
        	    <option value="math">คณิต</option>
        	    <option value="thai">ไทย</option>
        	    <option value="eng">อังกฦษ</option>
        	    <option value="chinese">จีน</option>
        	    <option value="dance">นาฏศิลป</option>
          </select>
          </div>
          <div class="col-sm-8 p-2 col-md-5 col-lg-4 text-sm-end text-start mt-2 col-12">
            เวลาที่ต้องการจอง :
          </div>
          <div class="col-sm-12 col-md-7 col-lg-6 p-2 ">
            <input name="date" type="date" size="50" required class="form-control">
          </div>
          <div class="col-sm-3 p-2 text-md-end col-lg-4 text-start mt-2">
            ที่อยู่ :
          </div>
          <div class="col-sm-9 p-2 col-lg-6">
            <textarea name="address" cols="30" rows="4" class="form-control"></textarea>
          </div>
          <div class="col-sm-5 col-md-3 p-2 col-lg-4 text-md-end  text-start mt-2">
            โทรศัพท์ :
          </div>
          <div class="col-sm-12 col-md-9 p-2 col-lg-6 ">
            <input name="telephone"  id="telephone" type="tel" maxlength="10" required class="form-control" placeholder="097-xxx-xxxx">
          </div>

          <div class="col-ms-10 p-2 text-center ">
            <input type="submit" name="butSubmit" value="ยืนยัน" class="btn btn-success">
            <a href="user.php" class="btn btn-secondary">ยกเลิก

            </a>
          </div>
        </div>       
      </form>





      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>