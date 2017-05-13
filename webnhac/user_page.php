<?php
require_once 'libraries/role.php';
include 'libraries/database.php';
include 'libraries/handle_user_page.php';
include 'libraries/list_user_song_in_user_page.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Pro MP3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.nivo.slider.js"></script>
        <script src='js/jquery.color-RGBa-patch.js'></script>
        <script src='js/example.js'></script>
        <link rel="stylesheet" href="css/user.css" type="text/css" media="all" />
        <script>
            function showExtendButon() {
                if (document.getElementById("extend_buton").firstChild.className === "glyphicon glyphicon-chevron-down") {
                    document.getElementById("extend_buton").firstChild.className = "glyphicon glyphicon-chevron-up";
                } else {
                    document.getElementById("extend_buton").firstChild.className = "glyphicon glyphicon-chevron-down";
                }
            }
        </script>
    </head>
    <body>
        <div class="wrap">
            <div class="h-bg">
                <?php require_once 'include/header.php'; ?>
                <div class="main">
                    <div class="main-top">
                        <div class="section-1">
                            <div class="header-section">
                                <h3>Danh sách các bài hát</h3>
                                <!-- upload bài hát -->
                                <a href='upload_page.php' class="mypage_icon"><span class="glyphicon glyphicon-upload"></span></a>
                                <!--nghe toan bo-->
                                <a href='#' class='mypage_icon' onclick="document.forms['listenAllUserSongs'].submit();"><span class="glyphicon glyphicon-headphones"></span></a>
                                <form name="listenAllUserSongs" method="post" action="player.php">
                                    <input type="hidden" name="listType" value="allUserSongs">
                                </form>

                            </div>
                            <hr>

                            <!-- hiện danh sách bài hát của người dùng -->

                            <?php
                            $sql = "select * from user_song where user_id = " . $_SESSION['user_id'];
                            $user_songs = mysqli_query($conn, $sql);
                            $user_song_count = mysqli_num_rows($user_songs);
                            $i = 1;
                            while ($i <= 12 && $row1 = mysqli_fetch_array($user_songs)) {
                                if ($i % 4 == 1) {
                                    ?>
                                    <div class="section group">
                                        <?php
                                    }
                                    ?>
                                    <div class="grid_1_of_4 images_1_of_4">
                                        <div class="grid-img">
                                            <?php
                                            $sql = "select * from baihat where baihat_id = '" . $row1['song_id'] . "'";
                                            $songs = mysqli_query($conn, $sql);
                                            $row2 = mysqli_fetch_array($songs); //row2 lưu các bài hát của người dùng với đầy đủ thuộc tính
                                            $song_name = $row2['tenbaihat'];
                                            ?>
                                            <img src=<?php echo "'images/" . $row2['duongdananh'] . "'" ?> alt=""/>
                                            <!-- xác định liên kết của bài hát-->
                                            <a href="#" onclick="document.forms['<?php echo 'user_song_submit_' . $row2['baihat_id'] ?>'].submit();"].submit();"><h3><?php echo $row2['tenbaihat'] ?> </h3></a>
                                            <form name="<?php echo 'user_song_submit_' . $row2['baihat_id'] ?>" method="post" action="player.php">
                                                <input type="hidden" name="listType" value="userSongs">
                                                <input type="hidden" name="current_song_path" value=<?php echo $row2['duongdan'] ?>>
                                            </form>

                                            <!-- Tải bài hát -->
                                            <div class="perform-with-song">
                                                <a class="mypage_icon" href=<?php echo "'path/" . $row2['duongdan'] . "'" ?> download=<?php echo "'" . $row2['tenbaihat'] . "'" ?> ><span class="glyphicon glyphicon-download"></span></a>

                                                <!--xóa bài hát của người dùng-->

                                                <a class="mypage_icon" data-toggle="modal" data-target=<?php echo "#delete_user_song_" . $row2['baihat_id'] ?> ><span class="glyphicon glyphicon-remove"></span></a>
                                                <div id= <?php echo "delete_user_song_" . $row2['baihat_id'] ?>  class = 'modal fade' role="dialog">
                                                     <div class = "modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                                <div class="header-section"><h3>Bạn có muốn xóa bài hát?</h3></div>
                                                                <form method="POST" action="user_page.php">
                                                                    <input style="display:block; float:right" class="btn btn-default" type="submit" value="có" name="delete"> 
                                                                    <input type="hidden" name="action" value="delete_user_song" >
                                                                    <input type="hidden" name="song_id" value=<?php echo $row1['song_id'] ?> >
                                                                </form>
                                                                <button style="display:block; float:right" class="btn btn-default" type="button" data-dismiss="modal">không</button>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($i % 4 == 0) {
                                        ?>
                                        <div class="clear"></div>
                                    </div>
                                    <?php
                                }
                                $i++;
                            }
                            ?>

                            <!--phần mở rộng của danh sách bài hát người dùng -->

                            <div id="extend_songs" class="collapse">
                                <?php
                                while ($row1 = mysqli_fetch_array($user_songs)) {
                                    if ($i % 4 == 1) {
                                        ?>
                                        <div class="section group">
                                            <?php
                                        }
                                        ?>
                                        <div class="grid_1_of_4 images_1_of_4">
                                            <div class="grid-img">
                                                <?php
                                                $sql = "select * from baihat where baihat_id = '" . $row1['song_id'] . "'";
                                                $song = mysqli_query($conn, $sql);
                                                $row2 = mysqli_fetch_array($song);
                                                $song_name = $row2['tenbaihat'];
                                                ?>
                                                <img src=<?php echo '"images/' . $row2['duongdananh'] . '"' ?> alt=""/>
                                                <!--xác định liên kết của bài hát -->
                                                <a href="#" onclick="document.forms['<?php echo 'user_song_submit_' . $row2['baihat_id'] ?>'].submit();"].submit();"><h3><?php echo $song_name ?></h3></a>
                                                <form name="<?php echo 'user_song_submit_' . $row2['baihat_id'] ?>" method="post" action="player.php">
                                                    <input type="hidden" name="listType" value="userSongs">
                                                    <input type="hidden" name="current_song_path" value=<?php echo $row2['duongdan'] ?>>
                                                </form>

                                                <div class="perform-with-song">
                                                    <!-- Tải bài -->

                                                    <a id="id1"  href=<?php echo "'path/" . $row2['duongdan'] . "'" ?> download=<?php echo "'" . $row2['tenbaihat'] . "'" ?><span class="glyphicon glyphicon-download"></span></a>

                                                    <!--xóa bài hát-->

                                                    <a class="mypage_icon" data-toggle="modal" data-target=<?php echo "#delete_user_song_" . $row2['baihat_id'] ?> ><span class="glyphicon glyphicon-remove"></span></a>
                                                    <div id= <?php echo "delete_user_song_" . $row2['baihat_id'] ?>  class = 'modal fade' role="dialog">
                                                         <div class = "modal-dialog">
                                                            <div class="modal-content">
                                                                <div class='modal-body'>
                                                                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                                    <div class="header-section"><h3>Bạn có muốn xóa bài hát?</h3></div>
                                                                    <form method="post" action="user_page.php">
                                                                        <input style="display:block;float:right" class="btn btn-default" type="submit" value="có" name="delete"> 
                                                                        <input type="hidden" name="action" value="delete_user_song" >
                                                                        <input type="hidden" name="song_id" value=<?php echo $row1['song_id'] ?> >
                                                                    </form>
                                                                    <button style="display:block;float:right" class="btn btn-default" type="button" data-dismiss="modal">không</button>
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($i % 4 == 0) {
                                            ?>
                                            <div class="clear"></div>
                                        </div>
                                        <?php
                                    }
                                    $i++;
                                }
                                ?>
                            </div>
                            <div class="clear"></div>

                            <?php
                            if ($i % 4 != 1) {
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <!-- nút mở rộng -->
                        <?php
                        if ($i > 12) {
                            echo "<button onclick='showExtendButon()' id='extend_buton' data-toggle='collapse' data-target='#extend_songs' type='button' class='btn btn-link'><span class='glyphicon glyphicon-chevron-down'></span></button>";
                        }
                        ?>
                        <!-- Hiển thị playlist của người dùng -->


                        <div class="section2">
                            <div class="header-section">
                                <h3>Danh sách các playlist</h3>

                                <!-- Thêm mới playlist -->

                                <a class='mypage_icon' data-toggle="modal" data-target="#add_playlist" ><span class="glyphicon glyphicon-plus"></span></a>
                                <div id="add_playlist" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3>Tạo playlist mới</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="user_page.php" class='form-group'>
                                                    <input type="hidden" name="action" value="add_playlist">
                                                    <input type="hidden" name="submit" value="true">
                                                    <b>Tên </b><input class="form-inline form-control" style="width: 400px" type="text" name="playlist_name" required><br>
                                                    <?php echo list_user_song() ?>
                                                    <hr>
                                                    <input style="display:block; float:right" class="btn btn-primary" type="submit" value="xong">
                                                </form>
                                                <button style='float:right' class="btn btn-primary" type="button" data-dismiss="modal" >hủy</button>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section_content">
                                <ul>
                                    <?php
                                    $result = mysqli_query($conn, "select * from playlist where user_id = " . $_SESSION['user_id']);
                                    $i = 0;
                                    while ($playlist = mysqli_fetch_array($result)) {
                                        ?>
                                        <li>
                                            <?php
                                            echo "<h4><a data-toggle='collapse' href= '#playlist_songs" . $i . "'>" . $playlist['name'] . "</a></h4>";
                                            ?>

                                            <!-- Chỉnh sửa playlist -->

                                            <a class='mypage_icon' data-toggle="modal" data-target=<?php echo "#change_playlist_" . $playlist['playlist_id'] ?> ><span class="edit_playlist glyphicon glyphicon-pencil"></span></a>
                                            <div class="modal fade" role="dialog" id=<?php echo "change_playlist_" . $playlist['playlist_id'] ?> >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <div class="header-section"><h3>Chỉnh sửa playlist</h3></div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="user_page.php" class="form-group">
                                                                <input type="hidden" name="action" value="change_playlist">
                                                                <input type="hidden" name="playlist_id" value=<?php echo $playlist['playlist_id'] ?> >
                                                                <?php echo list_playlist_song($playlist['playlist_id']); ?>
                                                                <hr>
                                                                <input style="display:block;float:right" class="btn btn-default" type="submit" value="xong">
                                                            </form>
                                                            <button style="float:right" class="btn btn-default" type="button" data-dismiss="modal">hủy</button>
                                                            <div class='clear'></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--xóa playlist -->

                                            <a class="mypage_icon" data-toggle="modal" data-target=<?php echo "#modal_delete_playlist" . $playlist['playlist_id'] ?> ><span class="delete_playlist glyphicon glyphicon-remove"></span></a>
                                            <div id=<?php echo "modal_delete_playlist" . $playlist['playlist_id'] ?> class ='modal fade' role='dialog' >
                                                 <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-body'>
                                                            <button class='close' type='button' data-dismiss='modal'>&times;</button>
                                                            <div class="header-section"><h3>Bạn có muốn xóa playlist này không?</h3></div>
                                                            <br>
                                                            <form method="post" action='user_page.php'>
                                                                <input style="display: block;float:right" class="btn btn-default" type='submit' value="có">
                                                                <input type='hidden' name='action' value="delete_playlist">
                                                                <input type='hidden' name='playlist_id' value=<?php echo $playlist['playlist_id'] ?>>
                                                            </form>
                                                            <button class="btn btn-default" style="display: block;float:right" type="button" data-dismiss='modal'>không</button>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- nghe toàn bộ -->
                                            <a class="mypage_icon" href="#" onclick="document.forms['<?php echo "listen_all_playlist_" . $playlist['playlist_id'] ?>'].submit();"><span class='glyphicon glyphicon-headphones'></span></a>
                                            <form name= '<?php echo "listen_all_playlist_" . $playlist['playlist_id'] ?>' method="post" action="player.php">
                                                <input type="hidden" name="listType" value="entirePlaylistSongs">
                                                <input type="hidden" name="playlist_id" value=<?php echo $playlist['playlist_id'] ?>>
                                            </form>

                                            <hr>
                                            <?php
                                            //truy xuất toàn bộ bài hát trong playlist và thông tin tương ứng
                                            $playlist_songs = mysqli_query($conn, "select * from playlist_song, baihat where playlist_id = " . $playlist['playlist_id'] . " and song_id = baihat_id");
                                            //liệt kê danh sách các bài hát trong playlist
                                            echo "<div class='collapse' id='playlist_songs" . $i . "'>";
                                            $j = 1;
                                            while ($playlist_song = mysqli_fetch_array($playlist_songs)) {
                                                ?>
                                                <?php
                                                if ($j % 4 == 1) {
                                                    echo '<div class="section group">';
                                                }
                                                ?>
                                                <div class='grid_1_of_4 images_1_of_4'>
                                                    <div class='grid-img'>
                                                        <img src='<?php echo 'images/' . $playlist_song['duongdananh'] ?>' alt="">
                                                        <!--xác định liên kết của bài hát -->
                                                        <a href="#" onclick="document.forms['<?php echo 'playlist_song_submit_' . $playlist_song['playlist_id'] . $playlist_song['song_id'] ?>'].submit();"].submit();"><h3><?php echo $playlist_song['tenbaihat'] ?></h3></a>
                                                        <form name='<?php echo 'playlist_song_submit_' . $playlist_song['playlist_id'] . $playlist_song['song_id'] ?>' method="post" action="player.php">
                                                            <input type="hidden" name="listType" value="playlistSongs">
                                                            <input type="hidden" name ="playlist_id" value='<?php echo $playlist_song['playlist_id'] ?>'>
                                                            <input type="hidden" name="current_song_path" value='<?php echo $playlist_song['duongdan'] ?>'>
                                                        </form>

                                                        <div>

                                                            <!-- dowload bài hát -->

                                                            <a id='id1' href=<?php echo "'path/" . $playlist_song['duongdan'] . "'" ?> download=<?php echo "'" . $playlist_song['tenbaihat'] . "'" ?><span class="glyphicon glyphicon-download"></span></a>

                                                            <!-- xóa bài hát ra khỏi playlist -->

                                                            <a class="mypage_icon" data-toggle="modal" data-target=<?php echo "#delete_playlist_song_" . $playlist_song['playlist_id'] . $playlist_song['baihat_id'] ?> ><span class="glyphicon glyphicon-remove"></span></a>
                                                            <div id= <?php echo "delete_playlist_song_" . $playlist_song['playlist_id'] . $playlist_song['baihat_id'] ?>  class = 'modal fade' role="dialog">
                                                                 <div class = "modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <button class="close" type="button" data-dismiss="modal">&times;</button>
                                                                            <div class="header-section"><h3>Xóa bài hát khỏi playlist?</h3></div>
                                                                            <form method="post" action="user_page.php">
                                                                                <input style="float:right" class="btn btn-default" type="submit" value="có"> 
                                                                                <input type="hidden" name="action" value="delete_playlist_song" >
                                                                                <input type="hidden" name="playlist_id" value=<?php echo $playlist_song['playlist_id'] ?> >
                                                                                <input type="hidden" name="song_id" value=<?php echo $playlist_song['song_id'] ?> >
                                                                            </form>
                                                                            <button class="btn btn-default" style="float:right" type="button" data-dismiss="modal">không</button>
                                                                            <div class="clear"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($j % 4 == 0) {
                                                    ?>
                                                    <div class="clear"></div>
                                                    </div>
                                                    <?php
                                                }
                                                $j++;
                                            }
                                            $i++;
                                            ?>
                                        </li>
                                        <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once 'include/footer.php'; ?>
            </div>
    </body>
</html>
<?php mysqli_close($conn); ?>