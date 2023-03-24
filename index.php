<?php
session_start();
include 'int.php';

$stmt = $con->prepare("SELECT *
                       from city");
$stmt->execute(array());
$items = $stmt->fetchAll();

?>
<!--------------------------------------------بداية الكاروسيل او السلايد شو-------------------------->
<div id="myslide" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators hidden-xs">
        <?php foreach ($items as $item) {
            $id =  intval($item['city_id']);
            echo '<li data-target="#myslide" data-slide-to="' . $id . '"';
            if ($id == 1) {
                echo  ' class="active"></li>';
            } else {
                echo '></li>';
            }
        }   ?>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php foreach ($items as $item) {
            $id =  intval($item['city_id']);
            echo '<div class="item';
            if ($id == 1) {
                echo ' active">';
            } else {
                echo '">';
            }
            echo  '<img src="layout/img/' . $item['photo'] . '" alt="pic1">';
            echo '<div class="carousel-caption">';
            echo '<h1>' . $item['name'] . '</h1>';

            echo ' <p class="lead hidden-xs">' . $item['description'] . '</p>';
            echo '<a href="city.php?city_id=' . $item['city_id'] . '"> <div class="btn btn-primary">visit us</div></a>';
            echo '</div>';
            echo '</div>';
        }  ?>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myslide" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myslide" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!---------------------------------------------نهاية الكاروسيل او السلايد شو------------------------------------------------>
<?php
include  "includes/templates/footer.php";
?>