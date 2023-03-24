<?php
session_start();
include 'int.php';
$shalet = 'shalet';
$resurant = 'Resturant';
$musem = 'musem';
$hotell = 'Hotel';

if (isset($_GET['city_id']) && is_numeric($_GET['city_id'])) {
    $cityID = intval($_GET['city_id']);
    $shalets = array();
    $hotels = array();
    $resutants = array();
    $musems = array();
    $shalets =   getplacebytype($cityID, $shalet);
    $hotels = getplacebytype($cityID, $hotell);
    $resutants = getplacebytype($cityID, $resurant);
    $musems = getplacebytype($cityID, $musem);
?>
    <!----------------------------------------------------------------->
    <section class="price_table text-center">
        <div class="container">
            <!--نضيف هيدينغ-->
            <h2 class="h1"> our Amazing places</h2>
            <div class="row">
                <?php
                if (!empty($hotels)) {
                    echo ' <div class="col-md-3 col-sm-6">';
                    echo '<div class="price_box wow fadeInUp" data-wow-duration="2s" data-wow-offset="400">';
                    echo '<h2 class="text-primary">Descover Our</h2>';
                    echo '<p class="center-block">hotels</p>';
                    echo '<ul class="list-unstyled">';
                    foreach ($hotels as $hotel) {

                        echo '<a href="places.php?placeID=' . $hotel['place_id'] . '"> <li>' . $hotel['name'] . '</li></a>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                }
                if (!empty($resutants)) {

                    echo ' <div class="col-md-3 col-sm-6">';
                    echo '<div class="price_box wow fadeInUp" data-wow-duration="2s" data-wow-offset="400">';
                    echo '<h2 class="text-primary"> Descover Our</h2>';
                    echo '<p class="center-block">Resutants</p>';
                    echo '<ul class="list-unstyled">';
                    foreach ($resutants as $resturant) {

                        echo '<a href="places.php?placeID=' . $resturant['place_id'] . '"> <li>' . $resturant['name'] . '</li></a>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                }
                if (!empty($shalets)) {
                    echo ' <div class="col-md-3 col-sm-6">';
                    echo '<div class="price_box wow fadeInUp" data-wow-duration="2s" data-wow-offset="400">';
                    echo '<h2 class="text-primary">Descover Our</h2>';
                    echo '<p class="center-block">Shalets</p>';
                    echo '<ul class="list-unstyled">';
                    foreach ($shalets as $shalet) {
                        echo '<a href="places.php?placeID=' . $shalet['place_id'] . '"> <li>' . $shalet['name'] . '</li></a>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                }
                if (!empty($musems)) {

                    echo ' <div class="col-md-3 col-sm-6">';
                    echo '<div class="price_box wow fadeInUp" data-wow-duration="2s" data-wow-offset="400">';
                    echo '<h2 class="text-primary">Descover Our</h2>';
                    echo '<p class="center-block">$Musems</p>';
                    echo '<ul class="list-unstyled">';
                    foreach ($musems as $musem) {
                        echo '<a href="places.php?placeID=' . $musem['place_id'] . '"> <li>' . $musem['name'] . '</li></a>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

    </section>
<?php
} else {

    echo "there is  no such a city";
}
include  "includes/templates/footer.php";

?>