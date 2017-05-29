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
            <title>Insert</title>

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
            require_once '../libraries/helper.php';
            global $conn;
            $error = array();
            $baihat_id = $_GET['baihat_id'];
            require_once 'sidebar.php';
            ?>
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
                <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                        <li class="active">Icons</li>
                    </ol>
                </div><!--/.row-->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chỉnh sửa bài hát</h1>
                    </div>
                </div><!--/.row-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <?php
                                if (is_submit('update')) {
                                    $chude_id = input_post('chude_id');
                                    $loibaihat = input_post('loibaihat');

                                    if (empty($chude_id)) {
                                        $error['chude_id'] = "Bạn chưa nhập chủ đề ID!";
                                    }

                                    if (!$error) {
                                        $sql = "UPDATE baihat SET chude_id = '{$chude_id}', loibaihat = '{$loibaihat}' WHERE baihat_id = '{$_GET['baihat_id']}'";
                                        mysqli_query($conn, $sql);
                                        ?>
                                        <script language="javascript">
                                            window.location = '<?php echo "http://localhost/webnhac/admin/baihat.php"; ?>';
                                        </script>
                                        <?php
                                    }
                                }
                                ?>
                                <form method="POST" action="<?php echo "http://localhost/webnhac/admin/update.php?baihat_id=$baihat_id"; ?>">
                                    <div class="col-md-6">                               
                                        <div class="form-group">
                                            <label>Chủ đề ID</label>
                                            <input class="form-control" type="text" name="chude_id">
                                            <?php show_error($error, 'chude_id'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Lời bài hát</label>
                                            <textarea class="form-control" rows="5" name="loibaihat"></textarea>
                                        </div>
                                        <input type="submit" name="Submit" class="btn btn-primary" value="Submit"> 
                                        <input type="hidden" name="request_name" value="update">
                                    </div>                               
                                </form>
                            </div>
                        </div>
                    </div><!-- /.col-->
                </div><!-- /.row -->
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
