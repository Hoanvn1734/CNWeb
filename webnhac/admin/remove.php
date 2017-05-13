<?php
require_once '../libraries/database.php';
require_once '../libraries/role.php';
if (is_logger() == null) {
    header("Location: ../login.php");
} else {
    global $conn;

    $sql = "DELETE FROM baihat WHERE baihat_id = '{$_GET['baihat_id']}'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: baihat.php?name=baihat&&page=1");
    } else {
        echo "Khong xoa duoc. " . mysqli_error($conn);
    }
}
?>