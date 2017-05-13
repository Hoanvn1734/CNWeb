<?php
// Ham kiem tra submit
function is_submit($key) {
    return (isset($_POST['request_name']) && $_POST['request_name'] == $key);
}

// Hàm lấy value từ $_POST
function input_post($key){
    return isset($_POST[$key]) ? trim($_POST[$key]) : false;
}

// Ham show error
function show_error($error, $key) {
    echo '<span style="color: red">'.(empty($error[$key]) ? "" : $error[$key]).'</span>';
}