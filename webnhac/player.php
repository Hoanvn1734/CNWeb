<?php
require_once 'libraries/role.php';
include 'libraries/database.php';
$songList = array();
if (isset($_POST['listType'])) {
    switch ($_POST['listType']):
        case 'userSongs': {
                $sql = 'select tenbaihat, casi_ten, duongdan from baihat, user_song, casi where user_id = ? and user_song.song_id = baihat.baihat_id and baihat.casi_id = casi.casi_id';
                if (($stmt = mysqli_prepare($conn, $sql))) {
                    if (mysqli_stmt_bind_param($stmt, 'i', $user_id)) {
                        $user_id = $_SESSION['user_id'];
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $songName, $singerName, $path);
                        $i = 0;
                        while (mysqli_stmt_fetch($stmt)) {
                            $songList[$i]['songName'] = $songName;
                            $songList[$i]['singerName'] = $singerName;
                            $songList[$i]['path'] = $path;
                            $i++;
                        }
                        mysqli_stmt_close($stmt);
                    }
                }
                break;
            }
        case 'playlistSongs': {
                $sql = 'select tenbaihat, casi_ten, duongdan from playlist_song, baihat, casi where playlist_song.song_id = baihat.baihat_id and baihat.casi_id = casi.casi_id and playlist_song.playlist_id=?';
                if (($stmt = mysqli_prepare($conn, $sql))) {
                    mysqli_stmt_bind_param($stmt, 'i', $playlist_id);
                    $playlist_id = $_POST['playlist_id'];
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $songName, $singerName, $path);
                    $i = 0;
                    while (mysqli_stmt_fetch($stmt)) {
                        $songList[$i]['songName'] = $songName;
                        $songList[$i]['singerName'] = $singerName;
                        $songList[$i]['path'] = $path;
                        $i++;
                    }
                    mysqli_stmt_close($stmt);
                }
                break;
            }

        case 'allUserSongs': {
                $sql = 'select tenbaihat, casi_ten, duongdan from user_song, baihat, casi where song_id = baihat_id and baihat.casi_id = casi.casi_id and user_id  = ?';
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'i', $user_id);
                $user_id = $_SESSION['user_id'];
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $songName, $singerName, $path);
                $i = 0;
                while (mysqli_stmt_fetch($stmt)) {
                    $songList[$i]['songName'] = $songName;
                    $songList[$i]['singerName'] = $singerName;
                    $songList[$i]['path'] = $path;
                    $i++;
                }
                mysqli_stmt_close($stmt);
                break;
            }
        case 'entirePlaylistSongs': {
                $sql = 'select tenbaihat, casi_ten, duongdan from playlist_song, baihat, casi where playlist_song.song_id = baihat.baihat_id and baihat.casi_id = casi.casi_id and playlist_id = ?';
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'i', $playlist_id);
                $playlist_id = $_POST['playlist_id'];
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $songName, $singerName, $path);
                $i = 0;
                while (mysqli_stmt_fetch($stmt)) {
                    $songList[$i]['songName'] = $songName;
                    $songList[$i]['singerName'] = $singerName;
                    $songList[$i]['path'] = $path;
                    $i++;
                }
                mysqli_stmt_close($stmt);
                break;
            }
    endswitch;
} else {
    exit();
}
?>
<!doctype html>
<html>
    <head>
        <title>Pro MP3</title>
        <link href = "css/style.css" rel = "stylesheet" type = "text/css" media = "all" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <link href = "css/default.css" rel = "stylesheet" type = "text/css" media = "all" />
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.audioControls.min.js"></script>
        <link rel="stylesheet" href="css/theme-2.css" type="text/css" media="all" />
        <script type="text/javascript">
            $(document).ready(function () {
                $("#playListContainer").audioControls({
                    autoPlay: true,
                    timer: 'increment',
                    onAudioChange: function (response) {
                        $('.songPlay').text(response.title + ' ...');
                    },
                    onVolumeChange: function (vol) {
                        var obj = $('.volume');
                        if (vol <= 0) {
                            obj.attr('class', 'volume mute');
                        } else if (vol <= 33) {
                            obj.attr('class', 'volume volume1');
                        } else if (vol > 33 && vol <= 66) {
                            obj.attr('class', 'volume volume2');
                        } else if (vol > 66) {
                            obj.attr('class', 'volume volume3');
                        } else {
                            obj.attr('class', 'volume volume1');
                        }
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="wrap">
            <div class="h-bg">
                <div class="header">
                    <div class="header-top">
                        <div class="enter">
                            <?php
                            if (is_logger() != null) {
                                ?>
                                <h3><a href="user_page.php"><?php echo get_user_name(); ?></a> | <a href="logout.php"> Đăng xuất</a></h3>
                                <?php
                            } else {
                                ?>
                                <h3><a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a></h3>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="nav-wrap">
                            <ul class="group" id="example-one">
                                <li class="current_page_item"><a href="index.php">Home</a></li>
                                <li><a href="albums.php">Albums</a></li>
                                <li><a href="about.php">About</a></li>                        
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div> 
                    </div>
                    <div class="header-bot">
                        <div class="logo">
                            <a href="index.php"><img src="images/logo.png" alt=""/></a>
                        </div>
                        <div class="search-bar">
                            <ul>
                                <form action="search.php" method="GET">
                                    <li><input type="text" name="search"></li>
                                    <input name="searchsubmit" type="image" src="images/search-icon.png" value="Go" id="searchsubmit" class="btn">
                                </form>
                            </ul>
                        </div>
                        <div class="clear"></div> 
                    </div>            
                </div>
                <div class="main">
                    <div class="main-top">
                        <!--nội dung player -->
                        <form id="fake-form">
                            <input type="hidden" name="primary-index" value="">
                        </form>
                        <div class="containerPlayer">
                            <div id="playerContainer">
                                <div id="controlContainer">
                                    <ul class="controls">
                                        <li><a href="#" class="shuffle" data-attr="shuffled"></a></li>
                                        <li><a href="#" class="left" data-attr="prevAudio"></a></li>
                                        <li><a href="#" class="play" data-attr="playPauseAudio"></a></li>
                                        <li><a href="#" class="right" data-attr="nextAudio"></a></li>
                                        <li><a href="#" class="repeat" data-attr="repeatSong"></a></li>
                                    </ul>
                                    <div class="audioDetails">
                                        <span class="songPlay"></span>
                                        <span data-attr="timer" class="audioTime"></span>
                                    </div>
                                    <div class="progress">
                                        <div data-attr="seekableTrack" class="seekableTrack"></div>
                                        <div class="updateProgress"></div>
                                    </div>
                                    <div class="volumeControl">
                                        <div class="volume volume3"></div>
                                        <input class="bar" data-attr="rangeVolume" type="range" min="0" max="1" step="0.1" value="0.7" />
                                    </div>
                                </div>
                            </div>
                            <div id="listContainer" class="playlistContainer">
                                <ul id="playListContainer">
                                    <?php
                                    $i = 0;
                                    if (strcmp($_POST['listType'], 'entirePlaylistSongs') == 0 || strcmp($_POST['listType'], 'allUserSongs') == 0) {
                                        $flag = FALSE;
                                        while ($i < count($songList)) {
                                            ?>

                                            <li data-src=<?php
                                            echo '"path/' . $songList[$i]['path'] . '"';
                                            if ($i == 0) {
                                                $flag = true;
                                                echo ' class="activeAudio"';
                                            }
                                            ?> >
                                                <a href="#"><?php echo $songList[$i]['songName'] . ' - ' . $songList[$i]['singerName']; ?></a>
                                                <?php
                                                if ($flag) {
                                                    ?>
                                                    <script>
                                                        document.forms['fake-form'].elements[0].value = 0;
                                                    </script>
                                                    <?php
                                                    $flag = FALSE;
                                                }
                                                ?>
                                            </li>
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        $flag = false;
                                        while ($i < count($songList)) {
                                            ?>
                                            <li data-src=<?php
                                            echo '"path/' . $songList[$i]['path'] . '"';
                                            if (strcmp($songList[$i]['path'], $_POST['current_song_path']) == 0) {
                                                echo ' class = "activeAudio"';
                                                $flag = true;
                                            }
                                            ?>>
                                                <a href="#"><?php echo $songList[$i]['songName'] . ' - ' . $songList[$i]['singerName']; ?></a>
                                                <?php
                                                if ($flag) {
                                                    ?>

                                                    <script type='text/javascript'>
                                                        document.forms['fake-form'].elements[0].value = <?php echo $i ?>;
                                                    </script>
                                                    <?php
                                                    $flag = FALSE;
                                                }
                                                ?>
                                            </li>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                    <!--
                                    <li data-src="path/anhkhachayemkhac_40.mp3">
                                        <a href="#">anh khác hay em khác</a>
                                    </li>
                                    -->
                                </ul>
                            </div>

                            <div class="clear"></div>
                        </div>
                        <!-- kết thúc nội dung -->
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <?php require_once 'include/footer.php'; ?>
            </div>
        </div>
    </body>
</html>

