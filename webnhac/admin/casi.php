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
            <title>Ca si</title>

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
            <?php require_once 'sidebar.php'; ?>
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
                <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                        <li class="active">Icons</li>
                    </ol>
                </div><!--/.row-->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Ca sĩ</h1>
                    </div>
                </div><!--/.row-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><a href="insert.php?name=casi">Thêm ca sĩ</a></div>
                            <div class="search-bar">
                                <ul>
                                    <form action="search.php?name=casi" method="POST">
                                        <input type="text" name="search" style="width: 20%; margin: 16px;" class="form-control" placeholder="Search">
                                        <input name="searchsubmit" type="hidden">
                                    </form>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table" border="1" bordercolor="gray" width="880">
                                    <thead>
                                        <tr>
                                            <th><center>Ca sĩ ID</center></th>
                                    <th><center>Tên ca sĩ</center></th>                                    
                                    </tr>
                                    <?php
                                    require_once '../libraries/paging.php';
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th><center><?php echo $row['casi_id']; ?></center></th>
                                            <th><center><?php echo $row['casi_ten']; ?></center></th>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </thead>
                                </table>
                                <div class="pagination">
                                    <?php
                                    // PHẦN HIỂN THỊ PHÂN TRANG
                                    // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                                    if ($current_page > 1 && $total_page > 1) {
                                        echo '<a href="casi.php?name=casi&&page=' . ($current_page - 1) . '">Prev</a> | ';
                                    }

                                    // Lặp khoảng giữa
                                    for ($i = 1; $i <= $total_page; $i++) {
                                        // Nếu là trang hiện tại thì hiển thị thẻ span
                                        // ngược lại hiển thị thẻ a
                                        if ($i == $current_page) {
                                            echo '<span>' . $i . '</span> | ';
                                        } else {
                                            echo '<a href="casi.php?name=casi&&page=' . $i . '">' . $i . '</a> | ';
                                        }
                                    }

                                    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút Next
                                    if ($current_page < $total_page && $total_page > 1) {
                                        echo '<a href="casi.php?name=casi&&page=' . ($current_page + 1) . '">Next</a> | ';
                                    }
                                    ?>
                                </div>
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
