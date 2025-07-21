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
                        <a class="nav-link px-3" href="form.php">คอร์สเรียน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active px-3"   href="list_data.php">ประวัติการลงทะเบียนทั้งหมด</a>
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
    <div class="container mt">
        <h2 style="text-align: center;">ผลการเปลี่ยนข้อมูลการลงทะเบียนเรียน</h2>
    </div>

  <div class="container m-2 p-2 d-flex justify-content-between">
    <?php 
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


        $E_name = $_POST['name'];
        $E_lastname = $_POST['lastname'];
        $Educations = $_POST['education'];
        $E_date = $_POST['date'];
        $E_address = $_POST['address'];
        $E_phone = $_POST['telephone'];
        
        $i_id=$_POST['i_id'];

    
    $sql="UPDATE education SET e_name='$E_name',e_lastname='$E_lastname',e_course='$Educations',e_date='$E_date',e_address='$E_address',e_phone='$E_phone' WHERE i_id='$i_id'";
        $result=$conn->query($sql);
        ?>
        
  </div>  
    <div class="card shadow-lg m-2 p-2 align-items-center mx-auto w-50" style="text-align: center;  ">
              
        ชื่อ <?php echo $E_name;?>
        นามสกุล <?php echo $E_lastname;?> <br>
        คอร์สทีสนใจ  <?php echo $Educations;?> <br>
        เวลาที่ต้องการจอง   <?php echo $E_date;?><br>
        ที่อยู่        <?php echo $E_address;?><br>
        โทรศัพท์      <?php echo $E_phone;?><br>
        <div>
            <a href="list_data.php" class="btn btn-danger">แสดงรายการจองของคุณ</a>
            <a  onclick='window.history.back()' class="btn btn-secondary"> ย้อนกลับ</a>
        </div>
    </div>
<?php
        $conn->close();
    ?>





      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>