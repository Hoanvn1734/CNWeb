<?php

session_start();
include 'database.php';
include 'convert_vietnamese_to_non_sign.php';

if (isset($_POST['song_name'])) {//chỉ thực hiện khi có post
    $song = filter_input(INPUT_POST, 'song_name');
    $singer = filter_input(INPUT_POST, 'singer_name');
    $author = filter_input(INPUT_POST, 'author');
    $class = filter_input(INPUT_POST, 'class');
    $lyric = filter_input(INPUT_POST, 'lyric');
    $qr = 'show table status like "baihat"';
    $result = mysqli_query($conn, $qr);
    $row = mysqli_fetch_array($result);
    $next_song_id = $row['Auto_increment'];
    //kiểm tra file ảnh
    $image_upload_ok = 0;
    $image_submited = false;
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        $image_submited = true;
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image_file"]["tmp_name"]);
        if ($check !== false) {
            $image_upload_ok = 1;
        } else {
            $image_upload_ok = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $image_upload_ok = 0;
        }
    }
    //kiểm tra file nhạc
    $check_audio = false;
    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] == 0) {
        $fname = $_FILES['audio_file']['name'];
        $file_name_parts = explode('.', $fname);
        $end_file_name = array_pop($file_name_parts);
        $ext = strtolower($end_file_name);
        if ($ext == 'mp3') {
            $check_audio = true;
        } else {
            $check_audio = false;
        }
    }

    //thông báo lỗi
    if (!$check_audio) {
        if (!isset($_SESSION['error'])) {
            $_SESSION['error'] = '';
        }
        $_SESSION['error'] .= '<div class="alert alert-danger"><strong>Lỗi:</strong>file nhạc không hợp lệ, upload không thành công</div>';
    }
    if ($image_upload_ok == 0 && $image_submited) {
        if (!isset($_SESSION['error'])) {
            $_SESSION['error'] = '';
        }
        $_SESSION['error'] .= '<div class="alert alert-warning"><strong>Cảnh báo:</strong>file ảnh không hợp lệ</div>';
    }

    //xử lý
    if ($check_audio) {
        $song_name_converted = convert_vi_to_en($song);
        $song_name_non_space = preg_replace('/\s+/', '', $song_name_converted);
        $file_name_in_dir = $song_name_non_space . '_' . $next_song_id;
        $path_to_store_audio = '../path/' . $file_name_in_dir . '.mp3';
        if ($image_upload_ok) {
            $path_to_store_image = '../images/' . $file_name_in_dir . '.' . $imageFileType;
            move_uploaded_file($_FILES['image_file']['tmp_name'], $path_to_store_image);
        }
        move_uploaded_file($_FILES['audio_file']['tmp_name'], $path_to_store_audio);

        //lưu vào cơ sở dữ liệu
        //lưu vào bảng ca sỹ
        $casi_id;
        $sql = 'select casi_id from casi where casi_ten= "' . $singer . '"';
        $result = mysqli_query($conn, $sql);
        if (($row = mysqli_fetch_array($result))) {
            $casi_id = $row[0];
        } else {
            mysqli_query($conn, 'insert into casi(casi_ten) values ("' . $singer . '")');
            $result = mysqli_query($conn, 'select max(casi_id) from casi');
            $row = mysqli_fetch_array($result);
            $casi_id = $row['0'];
        }
        //đường dẫn lưu trong cơ sở dữ liệu
        $path_to_image_in_db;
        if ($image_upload_ok == 1) {
            $path_to_image_in_db = $file_name_in_dir . '.' . $imageFileType;
        } else {
            $path_to_image_in_db = 'default.jpg';
        }
        $path_to_audio_in_db = $file_name_in_dir . '.mp3';
        //lưu vào bảng bài hát
        if (($stmt = $conn->prepare("INSERT INTO `baihat`(`tenbaihat`, `casi_id`, `tacgia`, `chude_id`, `duongdan`, `loibaihat`, `duongdananh`) VALUES (?, ?, ?, ?, ?, ?, ?)"))) {
            $stmt->bind_param('sisssss', $song, $casi_id, $author, $class, $path_to_audio_in_db, $lyric, $path_to_image_in_db);
            if (!$stmt->execute()) {
                var_dump($conn);
            }
            $stmt->close();
            if (!isset($_SESSION['error'])) {
                $_SESSION['error'] = '';
            }
            $_SESSION['error'] .= '<div class="alert alert-success">Thêm thành công!</div>';
        } else {
            echo mysqli_error($conn);
        }
        //cap nhat bai hat nguoi dung
        if (!mysqli_query($conn, 'insert into user_song (user_id, song_id) values (' . $_SESSION['user_id'] . ' , ' . $next_song_id . ')')) {
            echo mysqli_error($conn);
        }
    }
}
header('Location:../upload_page.php');
