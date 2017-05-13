<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '../libraries/role.php';
if (is_logger() == null) {
    header("Location: ../login.php");
} else {
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">

        <!--Icons-->
        <script src="js/lumino.glyphs.js"></script>

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        require_once '../libraries/database.php';
        require_once 'sidebar.php';
        global $conn;
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Icons</li>
                </ol>
            </div><!--/.row-->
            <?php
            if ($_GET['name'] == "chude") {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chủ đề</h1>
                    </div>
                </div><!--/.row-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="search-bar">
                                <ul>
                                    <form action="search.php?name=chude" method="POST">
                                        <input type="text" name="search" style="width: 20%; margin: 16px;" class="form-control" placeholder="Search">
                                        <input name="searchsubmit" type="hidden">
                                    </form>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (isset($_REQUEST['searchsubmit'])) {
                                    $search = addslashes($_POST['search']);
                                    if (empty($search)) {
                                        echo 'Nhập từ cần tìm kiếm!';
                                    } else {
                                        $sql = "SELECT chude_id, chude_ten FROM chude WHERE chude_ten LIKE '%$search%'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0 && $search != "") {
                                            ?>
                                            <table class="table" border="1" bordercolor="gray" width="880">
                                                <thead>
                                                    <tr>
                                                        <th><center>Chủ đề ID</center></th>
                                                <th><center>Tên chủ đề</center></th>
                                                </tr>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>                                              
                                                    <tr>
                                                        <th><center><?php echo $row['chude_id']; ?></center></th>
                                                    <th><center><?php echo $row['chude_ten']; ?></center></th>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "Không tìm thấy kết quả nào!";
                                            }
                                        }
                                    }
                                    ?>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else if ($_GET['name'] == "casi") {
                ?>
                <div class = "row">
                    <div class = "col-lg-12">
                        <h1 class = "page-header">Ca sĩ</h1>
                    </div>
                </div><!--/.row-->
                <div class = "row">
                    <div class = "col-lg-12">
                        <div class = "panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="search-bar">
                                <ul>
                                    <form action="search.php?name=casi" method="POST">
                                        <input type="text" name="search" style="width: 20%; margin: 16px;" class="form-control" placeholder="Search">
                                        <input name="searchsubmit" type="hidden">
                                    </form>
                                </ul>
                            </div>
                            <div class = "panel-body">
                                <?php
                                if (isset($_REQUEST['searchsubmit'])) {
                                    $search = addslashes($_POST['search']);
                                    if (empty($search)) {
                                        echo 'Nhập từ cần tìm kiếm!';
                                    } else {
                                        $sql = "SELECT casi_id, casi_ten FROM casi WHERE casi_ten LIKE '%$search%'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0 && $search != "") {
                                            ?>
                                            <table class="table" border="1" bordercolor="gray" width="880">
                                                <thead>
                                                    <tr>
                                                        <th><center>Ca sĩ ID</center></th>
                                                <th><center>Tên ca sĩ</center></th>
                                                </tr>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>                                              
                                                    <tr>
                                                        <th><center><?php echo $row['casi_id']; ?></center></th>
                                                    <th><center><?php echo $row['casi_ten']; ?></center></th>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "Không tìm thấy kết quả nào!";
                                            }
                                        }
                                    }
                                    ?>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else if ($_GET['name'] == "baihat") {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bài hát</h1>
                    </div>
                </div><!--/.row-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="search-bar">
                                <ul>
                                    <form action="search.php?name=baihat" method="POST">
                                        <input type="text" name="search" style="width: 20%; margin: 16px;" class="form-control" placeholder="Search">
                                        <input name="searchsubmit" type="hidden">
                                    </form>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (isset($_REQUEST['searchsubmit'])) {
                                    $search = addslashes($_POST['search']);
                                    if (empty($search)) {
                                        echo 'Nhập từ cần tìm kiếm!';
                                    } else {
                                        $sql = "SELECT baihat_id, tenbaihat, casi_ten, chude_ten, luotnghe FROM baihat, casi, chude WHERE baihat.casi_id = casi.casi_id AND chude.chude_id = baihat.chude_id AND tenbaihat LIKE '%$search%' OR casi_ten LIKE '%$search%'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0 && $search != "") {
                                            ?>
                                            <table class="table" border="1" bordercolor="gray" width="880">
                                                <thead>
                                                    <tr>
                                                        <th><center>Bài hát ID</center></th>
                                                <th><center>Tên bài hát</center></th>
                                                <th><center>Tên ca sĩ</center></th>
                                                <th><center>Tên chủ đề</center></th>
                                                <th><center>Lượt nghe</center></th>
                                                <th><center>Tùy chọn</center></th>
                                                </tr>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>                                              
                                                    <tr>
                                                        <th><center><?php echo $row['baihat_id']; ?></center></th>
                                                    <th><center><?php echo $row['tenbaihat']; ?></center></th>
                                                    <th><center><?php echo $row['casi_ten']; ?></center></th>
                                                    <th><center><?php echo $row['chude_ten']; ?></center></th>
                                                    <th><center><?php echo $row['luotnghe']; ?></center></th>
                                                    <th>
                                                    <center>
                                                        <a href="edit.php">Sửa</a>&nbsp; | &nbsp
                                                        <a href="remove.php?remove=baihat">Xóa</a>
                                                    </center>
                                                    </th>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "Không tìm thấy kết quả nào!";
                                            }
                                        }
                                    }
                                }
                                ?>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <script>
            !function ($) {
                $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                    $(this).find('em:first').toggleClass("glyphicon-minus");
                });
                $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
            }(window.jQuery);

            $(window).on('resize', function () {
                if ($(window).width() > 768)
                    $('#sidebar-collapse').collapse('show')
            })
            $(window).on('resize', function () {
                if ($(window).width() <= 767)
                    $('#sidebar-collapse').collapse('hide')
            })
        </script>	
    </body>
</html>
<?php } ?>
