<?php
session_start();

include 'int.php';

if (isset($_GET['placeID']) && is_numeric($_GET['placeID'])) {
    $placeID = intval($_GET['placeID']);
    $stmt = $con->prepare("SELECT places.*,city.name AS city_name
                    FROM places
                    INNER JOIN city on city.city_id = places.city_id
                    WHERE
                    places.place_id =?
                    ");
    $stmt->execute(array($placeID));

    $places = $stmt->fetch();
    echo $placeID;



?>
    <div class="container"></div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators my-one">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="layout\img\places\<?php echo $places['photo_1'];  ?>" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="layout\img\places\<?php echo $places['phpto_2'];  ?>" alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            ...
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    </div>
    <!-- ________________________________________________________________________________________________ -->
    <div class="container">

        <div class="item-info">
            <h2 class="text-center"><?php echo $places['type']; ?></h2>
            <p class="text-center"><?php echo $places['name']; ?></p>
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-calendar fa-fw"></i>
                    <span> name: </span> <?php echo $places['name']; ?>
                </li>

                <li>
                    <i class="fa fa-tags fa-fw"></i>
                    <span>city_name : </span><a href="#"> <?php echo $places['city_name']; ?></a>
                </li>
                <li>
                    <i class="fa fa-map fa-fw"></i>
                    <span>location: </span> <a href="<?php echo $places['locaition']; ?>">Visit us</a>
                </li>
                <li>
                    <i class="fa fa-facebook fa-fw"></i>
                    <span>facebook: </span> <a href="<?php echo $places['facebook']; ?>">Visit us</a>
                </li>
            </ul>
        </div>
        <!-- ____________________________________ عرض التعيقات _____________________________________________ -->

        <hr class="custom-hr">
        <!-- --------------------الاستعلام من الداتا بيس ----------------- -->
        <?php
        $stmt = $con->prepare("SELECT comment.*,users.user_name AS name 
                                FROM comment
                                INNER JOIN users ON users.user_id =comment.user_id 
                                WHERE comment.place_id =? 
                                AND status =1");
        $stmt->execute(array($placeID));
        $comments = $stmt->fetchAll();


        ?>
        <!------------------- نهاية الاستعلام من الداتا بيس  ----------------->

        <?php foreach ($comments as $comment) { ?>
            <!-- حطيناه بهالديف مشان التنسيق  -->
            <!-- شوفو بالسي اس اس  -->
            <div class="comment-box">
                <div class="row">
                    <!-- الكلاس تكست سنتر مشان يجي الاسم تبع العنصر تحت الصورة بلزبط بلنص يعني  -->
                    <div class="col-sm-2 text-center">
                        <!-- عطيناها كلاس ثمنيل لتعطي شكل حولها متل حواف  -->
                        <!-- عطيناها كلاس سركل لتعطي دائرة  -->
                        <!-- عطيناها سنتر بلوك هاد بيخليها تاخد مركز السنتر وتاخدو كلو للبلوك وتعمل مارجن متساوي  -->
                        <!-- وهالسنتر بلوك بيخلي اسم الممب يجي تحت الصورة مو جنبها لانها اخدت كل البلوك  -->
                        <?php echo $comment['name'] ?>
                    </div>
                    <div class="col-sm-10">
                        <p class="lead"><?php echo $comment['comment'] ?></p>
                    </div>
                </div>

            </div>
            <hr class="custom-hr">
            <!-- لاتنسا تروح شوف التنسيق بالسي اس اس  -->
        <?php } ?>


        <!-- _______________________________________________نهاية عرض التعليقات____________________________________________________ -->
        <!-- ____________________________________________________________بداية اضافة تعليق _________________________________________________ -->

        <?php if (isset($_SESSION['user'])) { ?>
            <div class="row">
                <div class="col-md-offset-3">
                    <!-- عملت دف وسميتو اد كومنت مشان نسقو بالسي اس اس روح شوفو -->
                    <div class="add-comment">
                        <!-- هاد للكومنت زحتو بمقدار 3 مشان يجي لكزومنت تحت البيانات الي فوق  -->
                        <!-- يعني مشان مايجي تحت الصورة  -->
                        <h3> Add your comment</h3>
                        <!-- هك كامل اضفت الايتم ايدي لحتى بس يجي يرجع يفوت من فوق ومعو الايتم ايدي مو يقلو ماعندي هك ايدي  -->
                        <!-- اتطلع فوق باول دخلتك عالصفحة وبتفهم اكتر  -->
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?placeID=' . $placeID; ?> " method="POST">
                            <textarea name="comment"></textarea>
                            <!-- عطيتو الكلاس الجاهز هاد  -->
                            <input class="btn btn-primary" type="submit" value="Add comment">
                        </form>
                        <?PHP if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                            $userid = $_SESSION['uid'];
                            $plceid =  $places['place_id'];
                            if (!empty($comment)) {
                                // --------بلش حطلي بالداتا ببس --------
                                $stmt = $con->prepare('INSERT INTO 
                                                            comments(comment,status,place_id,user_id )
                                                            VALUE(:zcomment,0,:zplceid,:zuserid)');
                                $stmt->execute(array(
                                    'zcomment' => $comment,
                                    'zplceid' => $plceid,
                                    'zuserid' => $userid
                                ));
                                // اذا تم الاستعلام 
                                if ($stmt) {
                                    echo '<div class="alert alert-success">comment is Added</div>';
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        <?php } else {
            // اذا منك مسجل دخول كول خرا مفي تضيف تعليق 
            echo "<a href='login.php'> login</a> or <a href='login.php'>regester</a> to to Add Comment";
        } ?>
        <!-- _______________________________________________________________ نهاية تعليق____________________________________________________________________ -->

    </div>
<?php

}


include  "includes/templates/footer.php";

?>