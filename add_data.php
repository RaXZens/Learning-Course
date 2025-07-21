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
    <div class="container mt-5 text-center">
        <h1>ยืนยันการรับข้อมูล</h1>
        <?php

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        

        if(isset($_POST['butSubmit'])){
        // รับข้อมูลจากหน้าฟอร์ม
        
        $E_name = $_POST['name'];
        $E_lastname = $_POST['lastname'];
        $Educations = $_POST['education'];
        $E_date = $_POST['date'];
        $E_address = $_POST['address'];
        $E_phone = $_POST['telephone'];
        $email=$_SESSION['email'];

        function generateReferenceNumber($conn) {
            // รับวันที่ในรูปแบบ YYYMMDD
            $date = date('Ymd');
            // หาหมายเลขลำดับล่าสุดที่มีในฐานข้อมูล (ถ้ามี)
            $sql = "SELECT reference_number FROM education WHERE reference_number LIKE 'ORD-$date%' ORDER BY i_id DESC limit 1";
            $result = $conn->query($sql);
        
            // ถ้ามีหมายเลขอ้างอิงที่ตรงกับวันที่นี้
            if ($result->num_rows > 0) {
                // รับหมายเลขอ้างอิงล่าสุด
                $row = $result->fetch_assoc();
                $lastReference = $row['reference_number'];
        
                // ดึงหมายเลขลำดับที่อยู่หลัง 'ORD-YYYYMMDD-'
                $lastNumber = (int)substr($lastReference, -3);
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // เพิ่มหมายเลขลำดับใหม่
            } else {
                // ถ้ายังไม่มีหมายเลขอ้างอิงสำหรับวันที่นี้
                $newNumber = '001'; // เริ่มต้นที่ 001
                
            }
        
            // สร้างหมายเลขอ้างอิงใหม่
            $referenceNumber = "ORD-$date-$newNumber";
            
            return $referenceNumber;
            
        }
        $newReference = generateReferenceNumber($conn);


        // SQL เพิ่ม Record\
            
        $sql = "INSERT INTO education (reference_number,username,e_name,e_lastname,e_course,e_date,e_address,e_phone) 
            VALUES ('$newReference','$Username','$E_name','$E_lastname','$Educations','$E_date','$E_address', '$E_phone')";
        }

        if (!is_numeric($E_phone)){
            echo 'ข้อมูลของเบอร์โทรต้องเป็นตัวเลขเท่านั้น <a href="form.php">ย้อนกลับ</a>';
            exit;
        }
        if (strlen($E_phone) !== 10) {
            echo 'กรุณากรอกเบอร์โทรให้ครบ 10 หลัก <a href="form.php">ย้อนกลับ</a>';
            exit;
        }

        if ($conn->query($sql) === TRUE) {
            echo "ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        ?>
        <div class="container m-3">
            <a href="user.php" class="btn btn-secondary">กลับสู่หน้าหลัก</a>
            
        </div>
        <?php $conn->close(); ?>
    </div>
</body>

</html>