<?php
require_once 'libraries/role.php';
include 'libraries/database.php';
global $conn;
?>
<!doctype html>
<html>
    <head>
        <title>Pro MP3</title>
        <link href = "css/style.css" rel = "stylesheet" type = "text/css" media = "all" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <link href = "css/default.css" rel = "stylesheet" type = "text/css" media = "all" />
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/user.css" type="text/css" media="all" />
    </head>
    <body>
        <div class="wrap">
            <div class="h-bg">
                <?php require_once 'include/header.php' ?>
                <div class="main">
                    <div class="main-top">
                        <div class="form_area">
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            ?>
                            <form method="POST" action="libraries/upload.php" enctype="multipart/form-data">
                                <div class="header-section"><h3>Thông tin bài hát</h3></div><br>
                                <div class="form-group">
                                    <label>Tên bài<sup>*</sup></label>
                                    <input type="text" style="width: 400px" class='form-control' name="song_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Ca sỹ<sup>*</sup></label>
                                    <input type="text" style="width: 400px" class="form-control" name="singer_name" required="">
                                </div>
                                <div class="form-group">
                                    <label>Nhạc sỹ</label>
                                    <input type="text" style="width: 400px" class="form-control" name="author" >
                                </div>
                                <div class="form-group">
                                    <label>Chủ đề ID<sup>*</sup></label>
                                    <select name="class">
                                        <?php
                                        $sql = "SELECT * FROM chude";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>                                          
                                                /                                           
                                                <option><?php echo $row['chude_id']; ?></option> &nbsp; <?php echo $row['chude_ten']; ?>                                                                              
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lời bài hát</label>
                                    <textarea class="form-control" name="lyric" rows="20" cols="80"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input type="file" name="image_file" id="image_file">
                                </div>
                                <div class="form-group">
                                    <label>File nhạc<sup>*</sup></label>
                                    <input type="file" name="audio_file" id="audio_file" required>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Xong">
                            </form>
                        </div>                    
                    </div>                   
                </div>
                <?php require_once 'include/footer.php'; ?>
            </div>
        </div>
    </body>
</html>

