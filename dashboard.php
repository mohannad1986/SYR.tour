<?php

session_start();
// الان اذا في سشن اسمو يوزر نيم يعني اذا جايني من
include 'int.php';

if (isset($_SESSION['user'])) {
    // ______________________
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['userId'])) {
        $userID = $_GET['userId'];
        echo $userID;
        $stmt4 = $con->prepare(" UPDATE users SET  req_status =1
                                                 where user_id =?  ");
        $stmt4->execute(array($userID));
    }



    // _________________________




    $stmt3 = $con->prepare("SELECT users.*
                              from users
                              where req_status = 0 ");
    $stmt3->execute(array());
    $unreqesterd = $stmt3->fetchAll();
?>
    <div class="container latest">
        <!-- رح حط هون البانيل الموجودة في موقع لبوتستراب  -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- هي مشان احفظ كم يوزر بدي اظهر وغير بالعدد عكيفي اتطلع تحن -->

                <!-- هي الايقونة الخاصة باليوزرز الموجودة في الفونت اوسم -->
                <i class="fa fa-users"></i> un registered users
            </div>
            <div class="panel-body">
                <!-- رح ضيف كلاس بوتستراب جاهز اسمو انستايلت نوع يول وضفلو اسم لتست يوزر مشان التنسيق -->
                <ul class='list-unstyled latest-users'>
                    <?php
                    foreach ($unreqesterd as $uuser) {
                        echo "<li>";
                        echo $uuser['user_name'];
                        // لاحظ عملنا بول رايت للبوتوم مشان يروح عاليمين
                        echo "<span class ='btn btn-success pull-right'>";
                        echo "<a href ='?userId=" . $uuser['user_id'] . "'><i class='fa fa-edit'></i>Activate";
                        echo "</a>'";
                        echo "</span>";
                        echo "</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>




<?php

    // --------- نهاية صفحة الداش بورد--------------
    include "includes/templates/footer.php";
} else {

    // رجعني ع صفحة اللوغ ان
    header('location: index.php');
    exit();
}
