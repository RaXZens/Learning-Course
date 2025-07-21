<?php include("connect.php"); 
    session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit; 
}?>
    
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
<nav class="sticky-top">
        <div class="container">
            <header>
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <a href="user.php"  class="d-inline-flex link-body-emphasis text-decoration-none">
                        <div class="img"><img src="image/image1.jpg"width="110" height="50"></div>
                        </a>
                    </div>

                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="user.php" class="nav-link px-9 link-dark link-hover-success">หน้าแรก</a></li>
                        <li><a href="form.php" class="nav-link px-3 link-dark">คอร์สเรียน</a></li>
                        <li><a href="list_data.php" class="nav-link px-3 link-dark">ประวัติการลงทะเบียนทั้งหมด</a></li>
                    </ul>
                    <div class="col-sm-3 text-end justify-content-end">
                        <?php if (isset($_SESSION['username'])) {
                            $Username = $_SESSION['username'];
                            echo "ยินดีต้อนรับ, คุณ " .$Username ;
                        } else {
                            echo "กรุณาล็อกอินเพื่อเข้าถึงหน้านี้";
                            // หรือเปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
                            header("Location: login.php");
                            exit;
                        }
                        ?>
                        
                        
                    </div>

                    <div class="col-sm-2 text-end">
                        <a href="logout.php" class="btn btn-danger" role="button">ออกจากระบบ</a>
                    </div>
            </header>
        </div>
    </nav>
<div class="container mt-5">
    <?php
    // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
            $i_id=$_GET['i_id'];

       $sql="DELETE FROM education WHERE i_id='$i_id'";
// รับค่า
    // SQL ลบข้อมูลทีละ record ตามเงื่อนไข

   
        $result=$conn->query($sql);
            header("location: list_data.php");
    ?>


</div>

    
</body>
</html>