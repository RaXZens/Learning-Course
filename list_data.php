<?php include("connect.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
} ?>


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
    <div class="row ">
        <div class="register-result col-sm-7  text-end ">
            <h2>ข้อมูลการลงทะเบียนเรียน</h2>
        </div>
        <div class="col-sm-5 text-center ">
            <a href="form.php" class="btn btn-success">เพิ่มข้อมูล</a>
            <a href="user.php" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
    </div>

    <div class="container m-2 p-2 ">
        <?php
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if (isset($_GET['page'])) {
            $Page = $_GET['page'];
        } else {
            $Page = 1;
        }

        $Record_Show = 3;
        $Offset = ($Page - 1) * $Record_Show;

        $sql = "SELECT i_id, reference_number, e_name, e_lastname, e_course, e_date, e_address,  e_phone, e_status  FROM education where username='$Username'ORDER BY i_id DESC ";
        $result = $conn->query($sql);
        $row_total = mysqli_num_rows($result);
        $page_total = ceil($row_total / $Record_Show);

        $sql .= "LIMIT $Offset,$Record_Show";
        $result = $conn->query($sql);
        ?>

        <?php

        if (mysqli_num_rows($result) > 0) {
            while ($rs = mysqli_fetch_assoc($result)) {
        ?>
    </div>
    <div class="card rounded-4 shadow-lg  p-2 m-2 mx-auto" style="text-align: center; width: 70%;">
        <?php switch ($rs["e_status"]) {
                    case 'processing':
                        $status_text = 'กำลังดำเนินการ'; ?>
                <p><span style="margin-right:5px; height: 10px; width: 10px; background-color:orange; border-radius: 50%; display: inline-block;"></span><?php echo $status_text; ?> </p>
            <?php
                        break;
                    case 'completed':
                        $status_text = 'ดำเนินการสำเร็จ'; ?>
                <p><span style="margin-right:5px; height: 10px; width: 10px; background-color:green; border-radius: 50%; display: inline-block;"></span><?php echo $status_text; ?> </p>
            <?php
                        break;
                    case 'failed':
                        $status_text = 'ล้มเหลว'; ?>
                <p><span style="margin-right:5px; height: 10px; width: 10px; background-color:red; border-radius: 50%; display: inline-block;"></span><?php echo $status_text; ?> </p>
        <?php
                        break;
                    default:
                        $status_text = 'ไม่ทราบสถานะ';
                        break;
                } ?>
        ชื่อ <?php echo $rs['e_name']; ?>
        นามสกุล <?php echo $rs['e_lastname']; ?>
        คอร์สทีสนใจ <?php echo $rs['e_course']; ?>
        เวลาที่ต้องการจอง <?php echo $rs['e_date']; ?>
        ที่อยู่ <?php echo $rs['e_address']; ?>
        โทรศัพท์ <?php echo $rs['e_phone']; ?>
        หมายเลขอ้างอืง <?php echo $rs['reference_number']; ?>

        <div class="mt-3">
            <a href="edit_from_data.php?i_id=<?php echo $rs['i_id']; ?>" class="btn btn-warning ">รายละเอียดการจอง/ชำระเงิน</a>
        </div>
        <?php

        ?>
    </div>


<?php
            } //end while
        } else {
            $_SESSION['hidden'] = "hiddenpagination";

?>

<div class="col-10 col-sm-12 col-md-12  ms-5 card-site shadow-lg m-2 p-2 d-flex justify-content-center " style="text-align: center; ">
    <?php echo "ยังไม่มีประวัติการทำรายการ"; ?>
</div>
<?php
        }

?>
<?php if (!isset($_SESSION['hidden'])) {

?>
    <div class="d-flex justify-content-center ">
        <ul style="background-color: white;" class="col-8  col-lg-5 rounded-2 d-flex justify-content-center gap-2 ">
            <li class="page-item col-5 col-lg-3 col-sm-3  text-end  <?= $Page > 1 ? '' : 'disabled' ?>">
                <a class="page-link text-black " href="?page=<?= $Page - 1;  ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $page_total; $i++): ?>
                <?php if ($Page <= 2): ?>
                    <?php if ($i <= 5): ?>
                        <li class="page-items  rounded-5 col-1 <?= $Page == $i ? "active" : "" ?>"><a class="page-link text-center text-black" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                    <?php elseif ($Page > 2):
                    if ($i <= $Page + 2 && $i >= $Page - 2): ?>
                        <li class="page-items rounded-5 col-1 <?= $Page == $i ? "active" : "" ?>"><a class="page-link text-center text-black" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif ?>
                <?php endif; ?>
            <?php endfor; ?>
            <li class="page-item col-4 col-lg-3 text-start <?= $Page < $page_total ? '' : 'disabled'  ?>">
                <a class="page-link text-black" href="?page=<?= $Page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only text-black">Next</span>
                </a>
            </li>
        </ul>
    </div>
    </div>
<?php } else {
    unset($_SESSION['hidden']);
} ?>
<?php $conn->close(); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>


</html>