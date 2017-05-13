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
                    $sql_1 = "";
                    if (empty($_GET['chude_id'])) {
                        $sql_1 = "SELECT chude_id, casi_ten, baihat_id, tenbaihat, duongdananh FROM baihat, casi WHERE baihat.casi_id = casi.casi_id ORDER BY RAND() LIMIT 8";
                    } else {
                        $sql_1 = "SELECT chude_id, casi_ten, baihat_id, tenbaihat, duongdananh FROM baihat, casi WHERE baihat.casi_id = casi.casi_id AND chude_id = '{$_GET['chude_id']}'";
                    }
                    $result_1 = mysqli_query($conn, $sql_1);
                    $array = array();
                    if (mysqli_num_rows($result_1) > 0) {
                        while ($row = mysqli_fetch_assoc($result_1)) {
                            $array[] = $row;
                        }
                        for ($i = 0; $i < count($array); $i++) {
                            if ($i % 3 == 0) {
                                ?>
                                <div class="right-bottom1">
                                <?php } ?>
                                <div class="grid_1_of_4 images_1_of_5">
                                    <div class="grid1-img">
                                        <a href="single.php?baihat_id=<?php echo $array[$i]['baihat_id']; ?>&&chude_id=<?php echo $array[$i]['chude_id']; ?>"><img src="images/<?php echo $array[$i]['duongdananh'] ?>" alt=""/></a>
                                        <div class="price-list">
                                            <h3><a href="single.php?baihat_id=<?php echo $array[$i]['baihat_id']; ?>&&chude_id=<?php echo $array[$i]['chude_id']; ?>"><?php echo $array[$i]['tenbaihat'] . " - " . $array[$i]['casi_ten']; ?> </a></h3>
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
                    }
                    ?>
                </div>	
                <div class="clear"></div>		
            </div>
        </div>
        <?php require_once 'include/footer.php'; ?>
    </div>
</div>