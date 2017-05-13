<?php
require_once 'libraries/database.php';
require_once 'libraries/role.php';
require_once 'libraries/helper.php';
require_once 'libraries/session.php';
$error = array();

if(is_submit('login')) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(empty($email)) {
        $error['email'] = "Ban chua nhap email.";
    }
    
    if(empty($password)) {
        $error['password'] = "Ban chua nhap mat khau.";
    }
    
    if(!$error) {
        include_once 'database/user.php';        
        $user = db_user_get_by_email($email);
        if(empty($user)) {
            $error['email'] = "Email dang nhap khong dung";
        } else if($user['user_pass'] != md5($password)) {
            $error['password'] = "Sai mat khau.";
        }
        if(!$error) {
            $_SESSION['user_id'] = $user['user_id'];
            set_logged($user['user_name'], $user['user_email'], $user['user_role']);
            if($user['user_role'] == '1') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
        }
    }
}
?>
<div class="wrap">
    <div class="h-bg">
        <?php require_once 'include/header.php'; ?>
        <div class="login">
            <div class="wrap">
                <div class="col_1_of_login span_1_of_login">
                    <h4 class="title">New Customers</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan</p>
                    <div class="button1">
                        <a href="register.php"><input type="submit" name="Submit" value="Đăng ký tài khoản"></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="col_1_of_login span_1_of_login">
                    <div class="login-title">
                        <h4 class="title">Đăng nhập</h4>
                        <div id="loginbox" class="loginbox">
                            <form action="<?php echo "http://localhost/webnhac/login.php"; ?>" method="POST" name="login" id="login-form">
                                <fieldset class="input">
                                    <p id="login-form-username">
                                        <label for="modlgn_username">Email</label>
                                        <input id="modlgn_username" type="text" name="email" class="inputbox" size="18" autocomplete="off" value="<?php echo input_post('email'); ?>">
                                        <?php show_error($error, 'email'); ?>
                                    </p>
                                    <p id="login-form-password">
                                        <label for="modlgn_passwd">Password</label>
                                        <input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" autocomplete="off">
                                        <?php show_error($error, 'password'); ?>
                                    </p>
                                    <div class="remember">
                                        <p id="login-form-remember">
                                            <label for="modlgn_remember"><a href="#">Forget Your Password ? </a></label>
                                        </p>
                                        <input type="hidden" name="request_name" value="login">
                                        <input type="submit" class="button" value="Đăng nhập">
                                        <div class="clear"></div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php require_once 'include/footer.php'; ?>
    </div>
</div>