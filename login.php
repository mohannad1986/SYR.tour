<?php
session_start();
$pagetitle = 'login';
if (isset($_SESSION['user'])) {
    header('location:index.php');
}
include 'int.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $hashpass = sha1($pass);
        $stmt = $con->prepare("SELECT 
                                    user_id,user_name,Password
                                        from
                                            users
                                        where
                                        
                                            user_name =? 
                                        AND 
                                            Password =? 
                                        AND 
                                        req_status =1
                                                ");

        $stmt->execute(array($user, $hashpass));
        $get = $stmt->fetch();
        $count = $stmt->rowcount();
        if ($count > 0) {
            $_SESSION['user'] = $user;
            $_SESSION['uid'] = $get['user_id'];
            header('location:index.php');
            exit();
        }
        // -----انتهاء اللوغ ان -----------------------------------------------
    } else {
        // لو مش لوغ ان يبقى ساين اب مبدا 
        $formerror = array();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        // -------------------------------------------------------
        if (isset($username)) {
            // الفلتر فار تابع بيفلتر المتحول وبندخخلو نوع التعقيم  مشان مافوت معو سكربتات والتاغات
            $filterduser = filter_var($username, FILTER_SANITIZE_STRING);

            if (strlen($filterduser) < 4) {
                $formerror[] = 'user name cannot be less than 4 charechters';
            }
        }
        // -------------------------------------------------------
        if (isset($password) && isset($password2)) {
            // لاحظ عم نتاكد من الباسورد اذا مش فاضية قبل مانهيشا لان لو هيشناها حتى لو فاضية بصير الها قيمة 
            if (empty($password)) {

                $formerror[] = 'password cannot be empty';
            }
            $shpass1 = sha1($password);
            $shpass2 = sha1($password2);
            if ($shpass1 !== $shpass2) {
                $formerror[] = 'soory passwords dosnt match';
            }
        }
        // ------------------------------------------------------

        // ----------------------------------العمل مع الداتا بيس -------------------------------
        if (empty($formerror)) {
            $check = checkitem("user_name", "users", $username);
            if ($check == 1) {
                // معناتا هالمسنخدم موجود في الداتا بيس 
                $formerror[] = "this user is exists";
            } else {

                $stmt = $con->prepare("INSERT INTO 
                                users(user_name,Password,req_status)
                                VALUES(:zuser,:zpass,0)");
                $stmt->execute(array(
                    'zuser' =>  $username,
                    'zpass' => $shpass1
                ));

                $succesmsg = 'congrats you are reqesterd user';
            }
        }
        // ----------------------------------------------نهاية العمل مع الداتا بيس----------------------
    }
}
?>
<!-- ----------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------- -->
<div class="container login-page">
    <h1 class="text-center">
        <span class="selected" data-class="login">login</span> |
        <span data-class="signup">signup</span>
    </h1>
    <!-- ------------------------------------------فورم اللوغ ان-------------------------------------------------------------------------------- -->
    <form class="login" method="POST" action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
        <div class=" input-container">
            <input class="form-control" type="text" name="username" autocomplete="off" placeholder="your user name" required />
        </div>
        <input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="your user password" />
        <input class="btn btn-primary btn-block" name="login" type="submit" value='login' />

    </form>
    <!-- -----------------------------------------فورم الساين اب---------------------------------------------------------- -->
    <form class="signup" method="POST" action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
        <!-- --------------------- -->
        <input pattern=".{4,8}" title="user name must be between 4 and 8" class="form-control" type="text" name="username" autocomplete="off" placeholder="your user name" required />
        <!-- -------------- --------->
        <!-- كمان هون للباسورد الحد الادنى اربع بيشتغل لمن بنشغل الريكوايرد -->
        <input minlength="3" class="form-control" type="password" name="password" autocomplete="new-password" placeholder="make it complex" required />
        <!-- ---------------------------- -->
        <input minlength="3" class="form-control" type="password2" name="password2" autocomplete="new-password" placeholder="type it again" required />
        <!-- ----------------------------------- -->
        <!-- لاحظ عطيتو هون كمان اسم بالعادة مابعطيه لميز بين هاد واللوغ ان وقت طلع البيانات عالميثود بوست  -->
        <!-- طلاع عالميثود بوست وشوف الفرق  -->

        <input class="btn btn-success btn-block" name="signup" type="submit" value='signup' />

    </form>
    <!-- ------------------------------------------------------------------------------------------------ -->
    <!-- هون بقا صفحة  طباعة االاخطاء  -->
    <div class="the-errors text-center">
        <?php
        if (!empty($formerror)) {
            foreach ($formerror as $error) {
                // كلاس مسج ارورو عاملو ومنسقو بالسي اس اس 
                echo "<div class='msg error'>" . $error . "</div>";
            }
        }
        if (isset($succesmsg)) {
            // كلاس السكسس عاملو بالسي اس اس مسج سكسس
            echo  "<div class='msg success'>" . $succesmsg  . "</div>";
        }
        ?>
    </div>
</div>
<?php
include "includes/templates/footer.php";
?>