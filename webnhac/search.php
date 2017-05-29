<?php
require_once 'libraries/database.php';
global $conn;
?>
<div class="wrap">
    <div class="h-bg">
        <?php
        require_once 'include/header.php';
        ?>
        <div class="main">
            <div class="content-bottom">			
                <div class="leftsidebar span_3_of_1">
                    <h3>Chủ đề</h3>
                    <div class="sidebar-nav">
                        <ul>
                            <?php
                            $sql = "SELECT chude_id, chude_ten FROM chude";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li>                                           
                                        <a href="albums.php?chude_id=<?php echo $row['chude_id']; ?>">
                                            <?php
                                            echo $row['chude_ten'];
                                        }
                                    }
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>				
                <div class="content span_1_of_2">                  
                    <?php
                    // Neu nguoi dung an nut search
                    if (isset($_REQUEST['searchsubmit'])) {
                        
                        // Loai bo khoang trang 2 dau de trong pha hoi cau truy van
                        $search = addslashes($_GET['search']);
                        if (empty($search)) { // Neu chua nhap tu khoa tim kiem
                            echo "Nhập từ cần tìm kiếm!";
                        } else { // Thuc hien cau lenh
                            $sql_1 = "SELECT casi_ten, baihat_id, chude_id, tenbaihat, duongdananh FROM baihat, casi"
                                    . " WHERE baihat.casi_id = casi.casi_id AND tenbaihat LIKE '%$search%'";
                            $result_1 = mysqli_query($conn, $sql_1);
                            $num = mysqli_num_rows($result_1);
                            if ($num > 0 && $search != "") {
                                while ($row_1 = mysqli_fetch_assoc($result_1)) {
                                    $array[] = $row_1;
                                }
                                echo "Có $num kết quả trả về<br><br>";
                                for ($i = 0; $i < count($array); $i++) {
                                    if ($i % 3 == 0) {
                                        ?>
                                        <div class="right-bottom1">
                                        <?php } ?>
                                        <div class = "grid_1_of_4 images_1_of_5">
                                            <div class = "grid1-img">
                                                <a href = "single.php?baihat_id=<?php echo $array[$i]['baihat_id']; ?>&&chude_id=<?php echo $array[$i]['chude_id']; ?>"><img src = "images/<?php echo $array[$i]['duongdananh'] ?>" alt = ""/></a>
                                                <div class = "price-list">
                                                    <h3><a href = "single.php?baihat_id=<?php echo $array[$i]['baihat_id']; ?>&&chude_id=<?php echo $array[$i]['chude_id']; ?>"><?php echo $array[$i]['tenbaihat'] . " - " . $array[$i]['casi_ten']; ?> </a></h3>
                                                    <div class="cart">
                                                        <div class="details-list">
                                                            <a href="" class="details"></a>
                                                            <a class="wish" title="Add to Wish List" onclick="addToWishList('43');"></a>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div> 
                                            </div>
                                        </div>
                                        <?php
                                        if ($i % 3 == 2 || ($i == count($array) - 1 && $i % 3 == 1) || ($i == count($array) - 1 && $i % 3 == 0)) {
                                            ?>
                                            <div class="clear"></div> 
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo "Không tìm thấy kết quả";
                            }
                        }
                    }
                    ?>
                </div>	
                <div class="clear"></div>		
            </div>
        </div>
        <?php require_once 'include/footer.php'; ?>
    </div>
</div>