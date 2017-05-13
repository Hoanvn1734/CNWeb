<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
global $conn;
require_once '../libraries/database.php';
require_once '../libraries/role.php';
if (is_logger() == null) {
    header("Location: ../login.php");
} else {
    ?>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Playlist</title>

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
                        <h1 class="page-header">Playlist</h1>
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
                                <table class="table" border="1" bordercolor="gray" width="880">
                                    <thead>
                                        <tr>
                                            <th><center>Playlist ID</center></th>
                                    <th><center>Tên playlist</center></th>
                                    <th><center>User name</center></th>
                                    <th><center>User email</center></th>
                                    </tr>
                                    <?php
                                    $sql = "SELECT playlist_id, name, user_name, user_email FROM playlist, user WHERE user.user_id = playlist.user_id";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th><center><?php echo $row['playlist_id']; ?></center></th>
                                            <th><center><?php echo $row['name']; ?></center></th>
                                            <th><center><?php echo $row['user_name']; ?></center></th>
                                            <th><center><?php echo $row['user_email']; ?></center></th>
                                            </tr>
                                            <?php
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
