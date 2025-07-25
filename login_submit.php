<?php 
    require('connection.inc.php'); 
    require('functions.inc.php');
    
    $email    = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);

    $res = mysqli_query($con,"select * from users where email='$email' and password='$password'");
    $check_user = mysqli_num_rows($res);
    if ($check_user > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($row['email']==$email) {
            $_SESSION['USER_LOGIN'] = 'yes';
            $_SESSION['ID'] = $row['id'];
            $_SESSION['USER_NAME'] = $row['name'];
            $_SESSION['USER_EMAIL'] = $row['email'];
            /*echo 'valid';*/
            echo json_encode(['msg'=>'valid']);
        }else{
            echo json_encode(['msg'=>'wrong']);
           /* echo 'wrong';*/
        }
    }else{
        echo json_encode(['msg'=>'wrong']);
        /*echo 'wrong'*/;
    }
    
 ?>   