<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SYR.tout</title>
    <link rel="stylesheet" href="layout/css/bootstrap.css" />
    <link rel="stylesheet" href="layout/css/font-awesome.min.css" />
    <link rel="stylesheet" href="layout/css/style.css" />
    <link rel="stylesheet" href="layout/css/media.css" />
    <link rel="stylesheet" href="layout/css/front.css" />
    <link rel="stylesheet" href="layout/css/defult-theme.css" />
    <link rel="stylesheet" href="layout/css/hover.css" />
    <link rel="stylesheet" href="layout/css/animate.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" />
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ---------------------------------------------------------------------------------------------------------- -->

<body>
    <?php
    $stmt = $con->prepare("SELECT city.city_id,city.name
    FROM city");
    $stmt->execute(array());
    $cities = $stmt->fetchAll();
    ?>
    <!------------------------------بداية الناف بار------------------------------->
    <nav class="navbar  navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-------------------------------------------------1-----------------------دف الهيدر------------------------------>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ournavbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-----------------------------نهاية الزر الخاص بالوضع الصغير------------------------------->
                <a class="navbar-brand hvr-grow-rotate" href="#">SYR<span> tour.</span></a>
            </div>
            <!----------------------------------------------------------2-----------------الدف التاني-------------------------------->
            <div class="collapse navbar-collapse" id="ournavbar">
                <!--اول يو ال عبارة عن ثلاث لنكات-->
                <!---لاحظ اضفت ناف بار داش رايت مشان يصير عاليمين احلا-->
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php"> Home </a></li>
                    <?php foreach ($cities as $city) {
                        echo '<li><a href="city.php?city_id=' . $city['city_id'] . '">' . $city['name'] . '</a></li>';
                    }   ?>
                    <!---الدروب داون بكبس عليه بيفتحلي شوية لنكات فرعية يعني بيفتح اليو ال الي تحتو-->
                    <li class="dropdown">
                        <?php if (isset($_SESSION['user'])) {
                            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $_SESSION['user'] . ' <span class="caret"></span></a>';
                            echo '<ul class="dropdown-menu">';
                            echo '<li><a href="logout.php">myProfile</a></li>';
                            echo '<li><a href="newadd.php">Add place</a></li>';
                            $userssession = intval($_SESSION['uid']);
                            if ($_SESSION['uid'] == 1) {
                                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                            }
                            echo '<li class="divider"></li>';
                            echo '<li><a href="logout.php">logout</a></li>';
                            echo '</ul>';
                        } else {
                            echo ' <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <span class="caret"></span></a>';
                            echo '<ul class="dropdown-menu">';
                            echo ' <li><a href="login.php">login</a></li>';
                            echo '<li><a href="login.php">signup</a></li>';
                            echo ' <li class="divider"></li>';
                            echo '<li><a href="#">about us</a></li>';
                            echo '</ul>';
                        }    ?>


                    </li>
                </ul>
            </div>
        </div>
        <!--نهاية الكونتينر المحتوي للناف بار-->
    </nav>
    <!---------------------------------------نهاية الناف بار------------------------------------------->