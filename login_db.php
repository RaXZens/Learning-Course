<?php include("connect.php");
        session_start();
      $errors=array();
       if (isset($_POST['login_Submit'])) {
            $Username=mysqli_real_escape_string($conn,$_POST['username']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);
       }

       if(empty($Username)) {
            array_push($errors, "Username required");
            
       }
       if(empty($password)) {
            array_push($errors, "password required");
            
       }

       if(count($errors)==0){
        $password=($password);
        $query = "SELECT * FROM user WHERE username = '$Username' AND password ='$password'";
        $result = mysqli_query($conn,$query);

            if (mysqli_num_rows($result)==1){                          
                $_SESSION['username'] = $Username;
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "your are now logged in";
                header("location: user.php");

            }else{
                array_push($errors,"Wrong username/password combination");
                $_SESSION['error'] = "ไม่มีชื่อผู้ใช้หรือรหัสผ่านที่ลงทะเบียน";
                header("location: login.php");

            }
       }
?>