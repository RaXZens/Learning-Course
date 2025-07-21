<?php include("connect.php"); ?>
<?php 

    session_start();
    $errors= array();
    
        if(isset($_POST['Reg_Submit'])){
            $Username=mysqli_real_escape_string($conn,$_POST['username']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $password_1=mysqli_real_escape_string($conn,$_POST['password_1']);
            $password_2=mysqli_real_escape_string($conn,$_POST['password_2']);
           
            if(empty($Username)){
                array_push($errors, "username is required");
            }
            if(empty($email)){
                array_push($errors, "email is required");
            }
            if(empty($password_1)){
                array_push($errors, "password is required");
            }
            if($password_1 != $password_2){
                array_push($errors, "two password do not match");
                $_SESSION['error']= "รหัสผ่านไม่ตรงกับด้านบน";
            }
           

        

            $user_check_query="SELECT * FROM user WHERE username = '$Username' OR email = '$email' ";
            $query = mysqli_query($conn,$user_check_query);
            $result = mysqli_fetch_assoc($query);

            if($result){
                if ($result['username']=== $Username){
                    array_push($errors,"ชื่อผู้ใช้ถูกใช้ไปแล้ว");
                }
                if ($result['email']=== $email){
                    array_push($errors,"อีเมลนี้ถูกใช้ไปแล้ว");
                }
                

            }
            

            if(count($errors)==0) {
                $password=($password_1);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql= "INSERT INTO user (username,email,password) VALUES('$Username','$email','$hashedPassword')";

                mysqli_query($conn,$sql);

                $_SESSION['username']= $Username;
                $_SESSION['email']= $email;
                $_SESSION['success']= "เข้าสู่ระบบแล้ว";
                header('location: user.php');
            }else{
                array_push($errors,"ชื่อผู้ใช้หรืออีเมลถูกใช้ไปแล้ว");
                $_SESSION['error'] = "เกิดข้อผิดพลาดในการลงทะเบียน กรุณาตรวจสอบความถูกต้อง";
                header("location: register.php");
            }
        }
    
    
    ?>
