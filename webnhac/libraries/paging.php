<?php

// PHẦN XỬ LÝ PHP
// BƯỚC 1: KẾT NỐI CSDL
require_once 'database.php';
global $conn;

if ($_GET['name'] == "baihat") {
    // BƯỚC 2: TÌM TỔNG SỐ RECORDS
    $result = mysqli_query($conn, 'SELECT COUNT(baihat_id) AS total FROM baihat');
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];

    // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 15;

    // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
    // tổng số trang
    $total_page = ceil($total_records / $limit);

    // Giới hạn current_page trong khoảng 1 đến total_page
    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

    // Tìm Start
    $start = ($current_page - 1) * $limit;

    // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH
    // Có limit và start rồi thì truy vấn CSDL lấy danh sách
    $result = mysqli_query($conn, "SELECT chude_ten, casi_ten, baihat_id, tenbaihat, luotnghe FROM baihat, casi, chude WHERE baihat.casi_id = casi.casi_id AND baihat.chude_id = chude.chude_id ORDER BY baihat_id ASC LIMIT $start, $limit");
} else if ($_GET['name'] == "casi") {
    // BƯỚC 2: TÌM TỔNG SỐ RECORDS
    $result = mysqli_query($conn, 'SELECT COUNT(casi_id) AS total FROM casi');
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];

    // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 15;

    // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
    // tổng số trang
    $total_page = ceil($total_records / $limit);

    // Giới hạn current_page trong khoảng 1 đến total_page
    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

    // Tìm Start
    $start = ($current_page - 1) * $limit;

    // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH
    // Có limit và start rồi thì truy vấn CSDL lấy danh sách
    $result = mysqli_query($conn, "SELECT * FROM casi LIMIT $start, $limit");
}