<?php
require_once 'libraries/database.php';
require_once 'libraries/helper.php';
global $conn;
?>
<div class="wrap">
    <div class="h-bg">
        <?php require_once 'include/header.php'; ?>
        <div class="main">
            <div class="section group">
                <div class="content span_1_of_2">
                    <?php
                    mysqli_query($conn, "UPDATE baihat SET luotnghe=luotnghe+1 WHERE baihat_id='{$_GET['baihat_id']}'");
                    $sql = "SELECT baihat_id, chude_id, casi_ten, tenbaihat, duongdananh, duongdan FROM casi, baihat WHERE casi.casi_id = baihat.casi_id AND baihat_id = '{$_GET['baihat_id']}'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {                            
                            if (is_logger() != null) { // Neu nguoi dung da dang nhap
                                ?>
                                <div class="grid images_3_of_2">
                                    <img src="images/<?php echo $row['duongdananh'] ?>" alt=""/>
                                </div>
                                <div class="desc span_3_of_2">
                                    <h3><?php echo $row['tenbaihat'] . " - " . $row['casi_ten']; ?></h3>                                
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>                                                                     
                                </div>
                                <audio style="width: 700px; height: 50px" src="path/<?php echo $row['duongdan']; ?>" preload="auto" controls loop></audio>
                                <?php
                                if (is_submit('themdanhsach')) {
                                    $data = array(
                                        'user_id' => $_SESSION['user_id'],
                                        'song_id' => $_GET['baihat_id']
                                    );
                                    db_insert('user_song', $data);
                                    ?>
                                    <script>
                                        window.location = '<?php echo "http://localhost/webnhac/user_page.php"; ?>';
                                    </script>
                                    <?php
                                }
                                ?> 
                                <div class="links">
                                    <form method="POST" action="single.php?baihat_id=<?php echo $row['baihat_id']; ?>&&chude_id=<?php echo $row['chude_id']; ?>">
                                        <div class="cart">
                                            <div class="details-list">
                                                <input type="submit" class="button btn-primary" title="Thêm vào danh sách" value="Thêm bài hát">
                                                <input type="hidden" name="request_name" value="themdanhsach">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="grid images_3_of_2">
                                    <img src="images/<?php echo $row['duongdananh'] ?>" alt=""/>
                                </div>
                                <div class="desc span_3_of_2">
                                    <h3><?php echo $row['tenbaihat'] . " - " . $row['casi_ten']; ?></h3>                                
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>                                
                                </div>
                                <audio style="width: 700px; height: 50px" src="path/<?php echo $row['duongdan']; ?>" preload="auto" controls loop></audio>
                                <?php
                            }
                        }
                    }
                    ?>
                    <div class="links"></div>
                    <div class="fb-comments" data-href="http://localhost/webnhac/single.php?baihat_id=<?php echo $row['baihat_id']; ?>&&chude_id=<?php echo $row['chude_id']; ?>" data-width="700" data-numposts="5"></div>
                </div>			
                <div class="rightsidebar span_3_of_1">
                    <div class="blog-bottom">
                        <h4>Archives</h4>
                        <ul class="categories">
                            <li class="firstItem"> <a href="#">
                                    June , 15</a>
                            </li>
                            <li> <a href="#">
                                    June , 15</a>
                            </li>
                            <li> <a href="#">
                                    June , 15</a>
                            </li>
                            <li> <a href="#">
                                    June , 15</a>
                            </li>
                            <li> <a href="#">
                                    June , 15</a>
                            </li>
                            <li class="lastItem"> <a href="#">
                                    June , 15</a>
                            </li>
                            <li class="lastItem"> <a href="#">
                                    June , 15</a>
                            </li>
                        </ul>
                    </div>
                    <div class="blog-bottom">
                        <h4>Các bài hát cùng thể loại</h4>
                        <?php
                        $sql = "SELECT baihat_id, chude_id, casi_ten, tenbaihat, duongdananh FROM baihat, casi"
                                . " WHERE baihat.casi_id = casi.casi_id AND chude_id = {$_GET['chude_id']} AND baihat_id != {$_GET['baihat_id']} ORDER BY RAND() LIMIT 4";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="post-list">
                                    <figure class="thumbnail">
                                        <a href="single.php?baihat_id=<?php echo $row['baihat_id']; ?>&&chude_id=<?php echo $row['chude_id']; ?>" title="Donec tempor libero"><img src="images/<?php echo $row['duongdananh']; ?>" alt="tempor"></a>
                                    </figure>
                                    <div class="post-text">
                                        <h5 class="head"><a href="single.php?baihat_id=<?php echo $row['baihat_id']; ?>&&chude_id=<?php echo $row['chude_id']; ?>"><?php echo $row['tenbaihat'] . " - " . $row['casi_ten']; ?></a></h5>
                                        <a href="#"><span class="italic">Read More</span></a>
                                    </div>
                                    <div class="clear"></div> 
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="clear"></div> 
            </div>
        </div>
        <?php require_once 'include/footer.php'; ?>
    </div>
</div>