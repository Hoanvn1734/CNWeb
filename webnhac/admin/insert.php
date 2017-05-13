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
            require_once '../libraries/convert_vietnamese_to_non_sign.php';
            $error = array();
            require_once 'sidebar.php';
            ?>
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
                <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                        <li class="active">Icons</li>
                    </ol>
                </div><!--/.row-->
                <?php if ($_GET['name'] == "chude") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Thêm chủ đề</h1>
                        </div>
                    </div><!--/.row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <?php
                                    if (is_submit('themchude')) {
                                        $data = array(
                                            'chude_ten' => input_post('tenchude')
                                        );

                                        if (empty(input_post('tenchude'))) {
                                            $error['tenchude'] = "Bạn chưa nhập tên chủ đề!";
                                        }

                                        if (!$error) {
                                            db_insert('chude', $data);
                                            ?>
                                            <script language="javascript">
                                                window.location = '<?php echo "http://localhost/webnhac/admin/chude.php"; ?>';
                                            </script>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <form method="POST" action="<?php echo "http://localhost/webnhac/admin/insert.php?name=chude"; ?>">
                                        <div class="col-md-6">                               
                                            <div class="form-group">
                                                <label>Tên chủ đề</label>
                                                <input class="form-control" type="text" placeholder="Name" name="tenchude">
                                                <?php show_error($error, 'tenchude'); ?>
                                            </div>
                                            <input type="submit" name="Submit" class="btn btn-primary" value="Submit"> 
                                            <input type="hidden" name="request_name" value="themchude">
                                        </div>                               
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.col-->
                    </div><!-- /.row -->
                <?php } else if ($_GET['name'] == "casi") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Thêm ca sĩ</h1>
                        </div>
                    </div><!--/.row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <?php
                                    if (is_submit('themcasi')) {
                                        $data = array(
                                            'casi_ten' => input_post('tencasi')
                                        );

                                        if (empty(input_post('tencasi'))) {
                                            $error['tencasi'] = "Bạn chưa nhập tên ca sĩ!";
                                        }

                                        if (!$error) {
                                            db_insert('casi', $data);
                                            ?>
                                            <script language="javascript">
                                                window.location = '<?php echo "http://localhost/webnhac/admin/casi.php?name=casi&&page=1"; ?>';
                                            </script>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <form method="POST" action="<?php echo "http://localhost/webnhac/admin/insert.php?name=casi"; ?>">
                                        <div class="col-md-6">                               
                                            <div class="form-group">
                                                <label>Tên ca sĩ</label>
                                                <input class="form-control" type="text" placeholder="Name" name="tencasi">
                                                <?php show_error($error, 'tencasi'); ?>
                                            </div>
                                            <input type="submit" name="Submit" class="btn btn-primary" value="Submit"> 
                                            <input type="hidden" name="request_name" value="themcasi">
                                        </div>                               
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.col-->
                    </div><!-- /.row -->
                <?php } else if ($_GET['name'] == "baihat") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Thêm bài hát</h1>
                        </div>
                    </div><!--/.row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <?php
                                    if (is_submit('thembaihat')) {
                                        $qr = 'show table status like "baihat"';
                                        $result = mysqli_query($conn, $qr);
                                        $row = mysqli_fetch_array($result);
                                        $next_song_id = $row['Auto_increment'];
                                        
                                        $path_fileanh = "";
                                        $song_name_converted = convert_vi_to_en(input_post('tenbaihat'));
                                        $song_name_non_space = preg_replace('/\s+/', '', $song_name_converted);
                                        $file_name_in_dir = $song_name_non_space . '_' . $next_song_id;

                                        if (empty(input_post('tenbaihat'))) {
                                            $error['tenbaihat'] = "Bạn chưa nhập tên bài hát!";
                                        }

                                        if (empty(input_post('casi_id'))) {
                                            $error['casi_id'] = "Bạn chưa nhập ca sĩ ID!";
                                        }

                                        if (empty(input_post('chude_id'))) {
                                            $error['chude_id'] = "Bạn chưa nhập chủ đề ID!";
                                        }

                                        if (!empty($_FILES['fileanh']['name'])) {
                                            $allowed_extensions_image = array('jpg', 'jpeg', 'png');
                                            if (!in_array(pathinfo($_FILES['fileanh']['name'], PATHINFO_EXTENSION), $allowed_extensions_image)) {
                                                $error['fileanh'] = "File bạn chọn không phải file ảnh!";
                                            } else {
                                                $path_fileanh = $file_name_in_dir . '.' . pathinfo($_FILES['fileanh']['name'], PATHINFO_EXTENSION);
                                            }
                                        } else {
                                            $path_fileanh = "default.jpg";
                                        }

                                        if (!empty($_FILES['filenhac']['name'])) {
                                            $allowed_extensions_audio = 'mp3';
                                            if ((pathinfo($_FILES['filenhac']['name'], PATHINFO_EXTENSION) != $allowed_extensions_audio)) {
                                                $error['filenhac'] = "File bạn chọn không phải file nhạc!";
                                            }
                                        } else {
                                            $error['filenhac'] = "Bạn chưa chọn file nhạc!";
                                        }
                                        
                                        $data = array(
                                            'tenbaihat' => input_post('tenbaihat'),
                                            'casi_id' => input_post('casi_id'),
                                            'tacgia' => input_post('tacgia'),
                                            'chude_id' => input_post('chude_id'),
                                            'duongdan' => $file_name_in_dir . '.mp3',
                                            'loibaihat' => input_post('loibaihat'),
                                            'luotnghe' => 0,
                                            'duongdananh' => $path_fileanh
                                        );

                                        if (!$error) {
                                            move_uploaded_file($_FILES['fileanh']['tmp_name'], "../images/" . $path_fileanh);
                                            move_uploaded_file($_FILES['filenhac']['tmp_name'], "../path/" . $file_name_in_dir . '.mp3');
                                            db_insert('baihat', $data);
                                            ?>
                                            <script language="javascript">
                                                alert("Them bai hat thanh cong!");
                                                window.location = '<?php echo "http://localhost/webnhac/admin/baihat.php?name=baihat&&page=1"; ?>';
                                            </script>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <form method="POST" action="<?php echo "http://localhost/webnhac/admin/insert.php?name=baihat"; ?>" enctype="multipart/form-data">
                                        <div class="col-md-6">                               
                                            <div class="form-group">
                                                <label>Tên bài hát</label>
                                                <input class="form-control" type="text" name="tenbaihat" value="<?php echo input_post('tenbaihat'); ?>">
                                                <?php show_error($error, 'tenbaihat'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Ca sĩ ID</label>
                                                <input class="form-control" type="text" name="casi_id" value="<?php echo input_post('casi_id'); ?>">
                                                <?php show_error($error, 'casi_id'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Tác giả</label>
                                                <input class="form-control" type="text" name="tacgia" value="<?php echo input_post('tacgia'); ?>">
                                                <?php show_error($error, 'tacgia'); ?>
                                            </div>                                   
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chủ đề ID</label>
                                                <input class="form-control" type="text" name="chude_id" value="<?php echo input_post('chude_id'); ?>">
                                                <?php show_error($error, 'chude_id'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Lời bài hát</label>
                                                <input class="form-control" type="text" name="loibaihat" value="<?php echo input_post('loibaihat'); ?>">
                                                <?php show_error($error, 'loibaihat'); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>File nhạc</label>
                                                <input type="file" name="filenhac">
                                                <?php show_error($error, 'filenhac'); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>File ảnh</label>
                                                <input type="file" name="fileanh">
                                                <?php show_error($error, 'fileanh'); ?>
                                            </div>
                                        </div>

                                        <input type="submit" name="Submit" class="btn btn-primary" value="Submit"> 
                                        <input type="hidden" name="request_name" value="thembaihat">                             
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.col-->
                    </div><!-- /.row -->
                <?php } ?>
            </div>
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