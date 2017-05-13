<?php
require_once 'libraries/database.php';

function db_user_get_by_email($email){
    global $conn;
    $email = addslashes($email);
    $sql = "SELECT * FROM user WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function db_user_validate($data) {
    global $conn;
    // Bien chua loi
    $error = array();
    
    if(isset($data['user_name']) && $data['user_name'] == '') {
        $error['user_name'] = "Bạn chưa nhập tên";
    }
    
    if(isset($data['user_email']) && $data['user_email'] == '') {
        $error['user_email'] = "Bạn chưa nhập Email";
    }
    
    if (isset($data['user_email']) && filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) === false){
        $error['user_email'] = 'Email không hợp lệ';
    }
    
    if(isset($data['user_pass']) && $data['user_pass'] == '') {
        $error['user_pass'] = "Bạn chưa nhập mật khẩu";
    }
    
    if(!($error) && isset($data['user_email']) && $data['user_email']) {
        $sql = "SELECT COUNT(user_id) as counter FROM user WHERE user_email='".addslashes($data['user_email'])."'";
        $result = mysqli_query($conn, $sql);
        $row = array();
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
        if($row['counter'] > 0) {
            $error['user_email'] = "Email này đã tồn tại";
        }
    }
    
    return $error;
}
