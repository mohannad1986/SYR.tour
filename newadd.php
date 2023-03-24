<?php
session_start();
$pagetitle = 'Add new place';
include 'int.php';

if (isset($_SESSION['user'])) {
    // ------------------------بداية ارسال البيانات للداتا بيس -----------------------------
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $photo = $_FILES['photo'];
        // هالاري فيا الاسم والحجم واسم مؤقت ونوع الملف 
        $photoName =  $_FILES['photo']['name'];
        $photoSize = $_FILES['photo']['size'];
        $photoTmp = $_FILES['photo']['tmp_name'];
        $photoType =  $_FILES['photo']['type'];
        // الان تحديد الاكستنشن يعني الانواع الي فيه يرفعها 
        $photoAllowExtention = array("jpeg", "jpg", "png", "gif");
        $photoExtintion = strtolower(end(explode('.', $photoName)));
        $formerrors = array();
        $city = $_POST['city'];
        $type = $_POST['type'];
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
        $faceBook = filter_var($_POST['faceBook'], FILTER_SANITIZE_STRING);
        if (!empty($photoName) && !in_array($photoExtintion, $photoAllowExtention)) {

            $formerrors[] = '<div class= "alert alert-danger">This Extintion is Not <strong>Allowed</strong> </div>';
        }
        if (empty($photoName)) {

            $formerrors[] = '<div class= "alert alert-danger"photo is <strong>Required</strong> </div>';
        }
        // هي المساحة بالبايت يعني 4 ميغا مالازم يتعداها 
        if ($photoSize > 4194304) {

            $formerrors[] = '<div class= "alert alert-danger">photo cannot be larger than <strong>4 MB</strong> </div>';
        }

        if (strlen($name) < 4) {
            $formerrors[] = 'item name must be atlest 4 charecher';
        }
        if (strlen($city) == 0) {
            $formerrors[] = 'you must choose city';
        }
        if (strlen($type) == 0) {
            $formerrors[] = 'you must choos type';
        }
        // ----------------------------------------الدخول للداتا-----------------------------------------------------
        if (empty($formerrors)) {

            $photoNewName = rand(0, 10000) . '_' . $photoName;
            move_uploaded_file($photoTmp, "layout\img\places\\" . $photoNewName);
            $stmt = $con->prepare("INSERT INTO 
                               places(name,locaition,facebook,type,city_id,photo_1,member_id)
                                VALUES(:zname,:zlocaition,:zfacebook,:ztype,:zcity_id,:zphoto_1,:zmember)");
            $stmt->execute(array(
                'zname' => $name,
                'zlocaition' => $location,
                'zfacebook' => $faceBook,
                'ztype' => $type,
                'zcity_id' => $city,
                'zphoto_1' => $photoNewName,
                'zmember' => $_SESSION['uid']
            ));
            if ($stmt) {
                $succesmsg = 'item has been Added';
            }
        }

        // -----------------------------------------------------------------------------------------------------
    }

?>
    <h1 class="text-center"><?php echo $pagetitle; ?></h1>
    <div class="creat-Ad block">
        <div class="container">
            <div class="panel panel-primary">

                <div class="panel-heading"><?php echo $pagetitle; ?></div>
                <div class="panel-body">
                    <div class="row">
                        <!-- ----------------------------------------------------------------------------------------------------------------------- -->
                        <h1 class="text-center">Add new place</h1>
                        <form class="form-horizontal" action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST" enctype="multipart/form-data">
                            <!-- -------------------------------------- -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 col-md-offset-1 control-label">the place name </label>
                                <div class="col-sm-10 col-md-6">
                                    <!-- لاحظ ضفت عالكلاس اسم لايف نيم مشان بالجيكوري عدل شغلة  -->
                                    <input type="text" name="name" class="form-control  live-name" required="required" placeholder="name of the place" />
                                </div>
                            </div>
                            <!-- ------------------------------------ -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 col-md-offset-1 control-label">location</label>
                                <div class="col-sm-10 col-md-6">
                                    <input type="text" name="location" class="form-control live-description" placeholder="past the link of the location here " />
                                </div>
                            </div>
                            <!-- ------------------------------------ -->
                            <div class="form-group  form-group-lg">
                                <label class="col-sm-2 col-md-offset-1 control-label">Face book</label>
                                <div class="col-sm-10 col-md-6">
                                    <input type="text" name="faceBook" class="form-control live-description" placeholder="past the link of your account here" />
                                </div>
                            </div>
                            <!-- ------------------------------------- -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 col-md-offset-1 control-label">type </label>
                                <div class="col-sm-10 col-md-4">
                                    <!-- عطيت السلكت كلاس جاهز بالبوتستراب  اسمو فورم كونترول ليعطي شكل حلو  -->
                                    <select name="type" class="form-control" required="required">
                                        <option value="0">...</option>
                                        <option value="Resturant">Resturant</option>
                                        <option value="Hotel">Hotel</option>
                                        <option value="musem">musem</option>
                                        <option value="shalet">shalet</option>
                                    </select>
                                </div>
                            </div>
                            <!-- ------------------------------------- -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 col-md-offset-1 control-label">city</label>
                                <div class="col-sm-10 col-md-4">
                                    <!-- عطيت السلكت كلاس جاهز بالبوتستراب  اسمو فورم كونترول ليعطي شكل حلو  -->
                                    <select name="city" class="form-control" required="required">
                                        <option value="0">...</option>
                                        <!-- الان بدي جيب اليوزرز من الداتا بيس  -->
                                        <?php

                                        foreach ($cities as $city) {
                                            echo "<option value='" . $city['city_id'] . "'>" . $city['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- ------------------------------------ -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 col-md-offset-1  control-label">photo 1</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="file" name="photo" class="form-control" />
                                </div>
                            </div>
                            <!-- ------------------------------------- -->

                            <!-- ------------------------------------- -->

                            <div class="form-group form-group-lg">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" value="add item" class="btn btn-primary btn-sm" />
                                </div>

                        </form>

                        <!-- --------------------------------------نهاية الاد--------------------------------------------------------- -->
                        <!-- ----------------------------------------------------------------------------------------------------------------- -->
                    </div>


                </div>
                <!-- --------------------fبداية البحث عن الاخطاء---------------------- -->
                <?php
                if (!empty($formerrors)) {
                    foreach ($formerrors as $error) {
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                }
                if (isset($succesmsg)) {
                    // لمن بيكون في سكسس مسج مفعلة يعني نجح الاد للايتم طبعلي عشي 
                    // كلاس جاهز بالبوتستراب 
                    echo  "<div class='alert alert-success'>" . $succesmsg  . "</div>";
                }
                ?>
                <!-- ---------------نهاية البحث عن الاخطاء----------------------------- -->
            </div>
        </div>
    </div>
    </div>
    <!-- -------------------------------------------------------------------------- -->

    <!-- -------------------------------------------------------------------------- -->

<?php
} else {
    header('location:login.php');
    exit();
}
include  "includes/templates/footer.php";

?>