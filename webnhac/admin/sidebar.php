<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '../libraries/database.php';
require_once '../libraries/role.php';
require_once '../libraries/role.php';
if (is_logger() == null) {
    header("Location: ../login.php");
} else {
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php"><span>Lumino</span>Admin</a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo get_user_name(); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                                <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                                <li><a href="../logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <form role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
            <ul class="nav menu">
                <li class="active"><a href="dashboard.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li><a href="chude.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Chủ đề</a></li>
                <li><a href="casi.php?name=casi&&page=1"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Ca sĩ</a></li>
                <li><a href="baihat.php?name=baihat&&page=1"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Bài hát</a></li>
                <li><a href="playlist.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Playlist</a></li>
                <li><a href="playlist_song.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Playlist - Bài hát</a></li>
                <li><a href="user_song.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> User - Bài hát</a></li>
                <li role="presentation" class="divider"></li>
            </ul>

        </div><!--/.sidebar-->
    </body>
</html>
<?php } ?>
