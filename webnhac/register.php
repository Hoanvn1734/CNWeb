<?php
require_once 'libraries/database.php';
require_once 'libraries/helper.php';
require_once 'libraries/role.php';
$error = array();
if (is_submit('register')) {
    // Lay danh sach du lieu tu form
    $data = array(
        'user_name' => input_post('username'),
        'user_email' => input_post('email'),
        'user_pass' => md5(input_post('password')),
        'user_role' => 0
    );

    require_once 'database/user.php';
    $error = db_user_validate($data);
    if (!$error) {
        // Neu insert thanh cong thi thong bao va chuyen ve trang index
        if (db_insert('user', $data)) {
            set_logged($data['user_name'], $data['user_email'], $data['user_role']);
            ?>
            <script language="javascript">
                alert('Tạo tài khoản thành công!');               
                window.location = '<?php echo "http://localhost/webnhac/login.php"; ?>';
            </script>
            <?php
        } else {
            die();
        }
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery1.min.js"></script>
        <!-- start menu -->
        <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/megamenu.js"></script>
        <script>$(document).ready(function () {
                $(".megamenu").megamenu();
            });</script>
        <script src="js/jquery.easydropdown.js"></script>
    </head>
    <body>
        <div class="wrap">
            <div class="h-bg">
                <?php
                require_once 'include/header.php';
                ?>
                <div class="register_account">
                    <div class="wrap">
                        <h4 class="title">Tạo tài khoản</h4>
                        <form method="POST" action="<?php echo "http://localhost/webnhac/register.php"; ?>">
                            <div class="col_1_of_2 span_1_of_2">
                                <div><label>Tên tài khoản* </label>
                                    <input type="text" name="username" value="<?php echo input_post('username'); ?>">
                                    <?php show_error($error, 'user_name'); ?>
                                </div>
                                <div><label>Email* </label>
                                    <input type="text" name="email" value="<?php echo input_post('email'); ?>" class="long">
                                    <?php show_error($error, 'user_email'); ?>
                                </div>
                                <div><label>Mật khẩu* </label>
                                    <input type="password" name="password" value="<?php echo input_post('password'); ?>">
                                    <?php show_error($error, 'user_pass'); ?>
                                </div>
                            </div>
                            <input type="hidden" name="request_name" value="register">
                            <input type="submit" class="button" value="Đăng ký">
                            <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
                <?php require_once 'include/footer.php'; ?>
            </div>
        </div>
    </body>
</html>