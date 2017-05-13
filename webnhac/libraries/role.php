<?php
require_once 'libraries/session.php';

// Ham thiet lap da dang nhap
function set_logged($user_name, $user_email, $role) {
    session_set('ss_user', array(
        'user_name' => $user_name,
        'user_email' => $user_email,
        'user_role' => $role
    ));
}

// Ham thiet lap dang xuat
function set_logout() {
    session_delete('ss_user');
    session_delete('user_id');
}

// Kiem tra xem da dang nhap chua
function is_logger() {
    $user = session_get('ss_user');
    return $user;
}

// Kiem tra co phai admin khong
//function is_admin() {
//    $user = is_logger();
//    if(!empty($user['user_role']) && $user['user_role'] == '1') {
//        return true;
//    }
//    return false;
//}

// Lay username cua nguoi dung hien tai
function get_user_name() {
    $user = is_logger();
    return isset($user['user_name']) ? $user['user_name'] : '';
}
