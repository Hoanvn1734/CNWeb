<?php

if (isset($_POST['action'])) {
    switch ($_POST['action']):
//xóa bài hát của người dùng
        case 'delete_user_song': {
                $stm = "delete from user_song where user_id = " . $_SESSION['user_id'] . ' and song_id = ' . $_POST['song_id'];
                if (!mysqli_query($conn, $stm)) {
                    echo mysqli_error($conn) . "<br>";
                }
                //xóa bài hát trong các playlist của người dùng chứa nó
                $query = 'select playlist.playlist_id from playlist, playlist_song where playlist.playlist_id = playlist_song.playlist_id and user_id = ? and song_id = ?';
                if (($stmt = mysqli_prepare($conn, $query))) {
                    mysqli_stmt_bind_param($stmt, 'ii', $user_id, $song_id);
                    $user_id = $_SESSION['user_id'];
                    $song_id = filter_input(INPUT_POST, 'song_id');
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $playlist_id);
                    //xoa lan luot bai hat trong cac playlist
                    $sql = 'delete from playlist_song where playlist_id = ? and song_id = ?';
                    if (($stmt1 = mysqli_prepare($conn, $sql))) {
                        mysqli_stmt_bind_param($stmt1, 'ii', $pl_id, $s_id);
                        $s_id = filter_input(INPUT_POST, 'song_id');
                        while (mysqli_stmt_fetch($stmt)) {
                            $pl_id = $playlist_id;
                            mysqli_stmt_execute($stmt1);
                        }
                    } else {
                        echo mysqli_errno($conn) . mysqli_error($conn);
                    }
                    mysqli_stmt_close($stmt1);
                    mysqli_stmt_close($stmt);
                } else {
                    echo mysqli_errno($conn) . mysqli_error($conn);
                    print_r($stmt);
                }
                //kết thúc xóa bài hát trong playlist
                break;
            }
//xóa bài hát trong playlist
        case 'delete_playlist_song': {
                $stm = 'delete from playlist_song where playlist_id = ' . $_POST['playlist_id'] . ' and song_id = ' . $_POST['song_id'];
                if (!mysqli_query($conn, $stm)) {
                    echo mysqli_errno($conn);
                }
                break;
            }
        case 'delete_playlist': {
                $stm = 'delete from playlist where playlist_id = ' . $_POST['playlist_id'] . ' and user_id = ' . $_SESSION['user_id'];
                if (!mysqli_query($conn, $stm)) {
                    echo mysqli_error($conn);
                }
                break;
            }
        case 'add_playlist': {
                $stm = 'select * from user_song where user_id=' . $_SESSION['user_id'] . ' order by song_id';
                $stm_insert_playlist_id = 'insert into playlist (name, user_id) values ("' . $_POST['playlist_name'] . '", ' . $_SESSION['user_id'] . ')';
                if (!mysqli_query($conn, $stm_insert_playlist_id)) {
                    echo $stm_insert_playlist_id;
                    echo mysqli_error($conn);
                }

                $id = $conn->insert_id;
                if (!($result = mysqli_query($conn, $stm))) {
                    echo mysql_error($conn);
                }
                while ($row = mysqli_fetch_array($result)) {
                    if (isset($_POST[$row['song_id']])) {
                        $stm_insert_song_to_playlist = 'insert into playlist_song values (' . $id . ', ' . $row['song_id'] . ')';
                        if (!mysqli_query($conn, $stm_insert_song_to_playlist)) {
                            echo mysqli_error($conn);
                            echo $stm_insert_song_to_playlist;
                        }
                    }
                }
                break;
            }
        case 'change_playlist': {
                mysqli_query($conn, 'delete from playlist_song where playlist_id=' . $_POST['playlist_id']);
                $stm = 'select * from user_song where user_id=' . $_SESSION['user_id'] . ' order by song_id';
                $user_songs = mysqli_query($conn, $stm);
                while ($user_song = mysqli_fetch_array($user_songs)) {
                    if (isset($_POST[$user_song['song_id']])) {
                        $stm = 'insert into playlist_song values (' . $_POST['playlist_id'] . ', ' . $user_song['song_id'] . ')';
                        if (!mysqli_query($conn, $stm)) {
                            mysqli_error($conn);
                        }
                    }
                }
                break;
            }
    endswitch;
    header("Location:user_page.php");
}