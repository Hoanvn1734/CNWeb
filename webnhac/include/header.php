<?php
require_once 'libraries/database.php';
require_once 'libraries/role.php';
global $conn;
?>
<!DOCUMENT TYPE>
<html>
    <header>
        <title>Free ProMp3 Website Template | Home :: w3layouts</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css" media="all" />
        <script src="js/jquery-1.9.0.min.js"></script>
        <script src="js/jquery.nivo.slider.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $('#slider').nivoSlider();
            });
        </script>
        <!--nav-->
        <script src='js/jquery.color-RGBa-patch.js'></script>
        <script src='js/example.js'></script>
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </header>
    <body>       
        <div class="header">
            <div class="header-top">
                <div class="enter">
                    <?php
                    if (is_logger() != null) {
                        ?>
                    <h3><a href="user_page.php"><?php echo get_user_name(); ?></a> | <a href="logout.php"> Đăng xuất</a></h3>
                        <?php
                    } else {
                        ?>
                        <h3><a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a></h3>
                        <?php
                    }
                    ?>
                </div>
                <div class="nav-wrap">
                    <ul class="group" id="example-one">
                        <li class="current_page_item"><a href="index.php">Home</a></li>
                        <li><a href="albums.php">Albums</a></li>
                        <li><a href="about.php">About</a></li>                        
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="clear"></div> 
            </div>
            <div class="header-bot">
                <div class="logo">
                    <a href="index.php"><img src="images/logo.png" alt=""/></a>
                </div>
                <div class="search-bar">
                    <ul>
                        <form action="search.php" method="GET">
                            <li><input type="text" name="search"></li>
                            <input name="searchsubmit" type="image" src="images/search-icon.png" value="Go" id="searchsubmit" class="btn">
                        </form>
                    </ul>
                </div>
                <div class="clear"></div> 
            </div>            
        </div>
    </body>
</html>
