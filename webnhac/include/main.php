<?php
require_once 'libraries/database.php';
global $conn;
?>
<div class="main">
    <div class="main-top">
        <div class="section group">
            <?php
            $sql = "SELECT casi_ten, baihat_id, tenbaihat, luotnghe, chude_id, duongdananh FROM baihat, casi WHERE baihat.casi_id = casi.casi_id ORDER BY baihat_id DESC LIMIT 4";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <div class="grid-img">
                            <img src="images/<?php echo $row['duongdananh']; ?>" alt=""/>
                            <a href="single.php?baihat_id=<?php echo $row['baihat_id']; ?>&&chude_id=<?php echo $row['chude_id']; ?>"><h3><?php echo $row['tenbaihat'] . " - " . $row['casi_ten']; ?></h3></a>
                            <div class="views">Lượt nghe: <?php echo $row['luotnghe']; ?></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="clear"></div> 
        </div>
        <div class="content-middle">
            <div class="content-panel">
                <div class="span1"><p>&nbsp;</p>
                    <h2 style="text-align: right;">&nbsp;Welcome!</h2>
                </div>
                <div class="span2">
                    <div class="vertical-divider">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan tium totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi archit ecto beatae vitae dicta sunt explicabo. Nemo enim ipsam.</div> 
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="content-bottom">			
            <div class="leftsidebar span_3_of_1">
                <h3>Top 10<br> bài hát</h3>                
            </div>
            <div class="content span_1_of_2">
                <?php
                $sql_2 = "SELECT casi_ten, baihat_id, tenbaihat, duongdananh, chude_id, luotnghe FROM baihat, casi WHERE baihat.casi_id = casi.casi_id ORDER BY luotnghe DESC LIMIT 10";
                $result_2 = mysqli_query($conn, $sql_2);
                $array = array();
                if (mysqli_num_rows($result_2) > 0) {
                    while ($row_1 = mysqli_fetch_assoc($result_2)) {
                        $array[] = $row_1;
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
                                        <h3><a href="single.php?baihat_id=<?php echo $array[$i]['baihat_id']; ?>&&chude_id=<?php echo $array[$i]['chude_id']; ?>"><?php echo $array[$i]['tenbaihat'] . " - " . $array[$i]['casi_ten']; ?></a></h3>
                                        <div class="views">Lượt nghe: <?php echo $array[$i]['luotnghe']; ?></div>
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
</div>