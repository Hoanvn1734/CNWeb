<?php
function list_user_song() {
    global $conn;
    $stm = 'select * from user_song, baihat where user_id=' . $_SESSION['user_id'] . ' and song_id=baihat_id' . " order by song_id";
    $result = mysqli_query($conn, $stm);
    while ($row = mysqli_fetch_array($result)) {
        echo '<input type=checkbox name=' . $row['song_id'] . '> ' . $row['tenbaihat'] . '<br>';
    }
}

function list_playlist_song($playlist_id) {//hiển thị danh sách các bài hát cửa người dùng, check sẵn các bài hát đã có trong playlist
    global $conn;
    $stm1 = 'select * from playlist_song where playlist_id = ' . $playlist_id . " order by song_id";
    $stm2 = 'select * from user_song, baihat where user_id=' . $_SESSION['user_id'] . ' and song_id=baihat_id order by song_id';
    $playlist_songs = mysqli_query($conn, $stm1);
    $playlist_song_ids = array();
    while ($song = mysqli_fetch_array($playlist_songs)) {
        array_push($playlist_song_ids, $song['song_id']);
    }
    $user_songs = mysqli_query($conn, $stm2); //các bài hát của người dùng với đầy đủ thông tin
    while ($user_song = mysqli_fetch_array($user_songs)) {
        $flag = array_search($user_song['song_id'], $playlist_song_ids);
        if (is_numeric($flag)) {
            echo '<div class="checkbox"><label><input type=checkbox name=' . $user_song['song_id'] . ' checked>' . $user_song['tenbaihat'] . '</label></div>';
        } else {
            echo '<div class="checkbox"><label><input type=checkbox name=' . $user_song['song_id'] . ' >' . $user_song['tenbaihat'] . '</label></div>';
        }
    }
}
