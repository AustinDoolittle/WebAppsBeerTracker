<?php require_once("master_top.php");
include $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';

$connBeer = db_connect();
$connBrewery = db_connect();


if($connBeer == NULL || $connBrewery == NULL) {
          die("There was an error connecting to the database");
}

$queryBeer = $connBeer->prepare("SELECT AVG(r.Rating), be.Name, br.Name, be.Description, be.ID FROM Rating r JOIN Beers be ON (r.Beer = be.ID) JOIN Breweries br ON (be.Brewery = br.ID) GROUP BY r.Beer ORDER BY r.Rating DESC");
$queryBeer->execute();
$queryBeer->bind_result($avgBeerRating, $beerName, $breweryName, $beerDesc, $beerID); 


$queryBrewery = $connBrewery->prepare("SELECT AVG(r.Rating), br.Name, br.Description, br.ID FROM Rating r JOIN Beers be ON (r.Beer = be.ID) JOIN Breweries br ON (be.Brewery = br.ID) GROUP BY br.ID ORDER BY r.Rating DESC");
$queryBrewery->execute();
$queryBrewery->bind_result($avgBreweryRating, $breweryName, $breweryDesc, $breweryID); 
?>


<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
     <a href="./brewery.php?id=8"> <img src="Images/Index/featuredBrewery_mitten.png" alt="Featured Brewery"></a>
    </div>

    <div class="item">
      <a href="./beer.php?id=41"> <img src="Images/Index/featuredBeer_rubaeus.png" alt="Featured Beer"></a>
    </div>

    <div class="item">
      <a href="http://www.mlive.com/beer/2016/11/bells_brewery_calendar_of_2017.html#incart_river_index" target="_blank"><img src="Images/Index/beerNews_oberon.png" alt="Beer News"></a>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
</div>


<div class="row">
    
    <div class="col-sm-4 col-md-offset-2">
        <div class="list-group">
            <a href="./beers.php" class="list-group-item active">
            <h3 class="list-group-item-heading list-heading-custom">Highest Rated Beers</h3>
            </a>

        <?php
            $countBeer = 1;
            while($queryBeer->fetch() && $countBeer < 6) {
        ?>
                <a href="beer.php?id=<?php echo $beerID ?>"" class="list-group-item active">
                <h3 class="list-group-item-heading"><?php echo $countBeer ?>.&nbsp;<?php echo $beerName ?></h3>
                <?php if ($avgBeerRating < 1.5) {
                   ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span>
                    </p>
                    
                    <?php
                }
                    else if ($avgBeerRating >= 1.5 && $avgBeerRating < 2.5) {
                         ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                 </p>
                    <?php
                }
                       else if ($avgBeerRating >= 2.5 && $avgBeerRating < 3.5) {
                            ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($avgBeerRating >= 3.5 && $avgBeerRating < 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($avgBeerRating >= 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
            
            ?>
 
                <p class="list-group-item-text brewery-list"><?php echo $breweryName ?></p>
                <p class="list-group-item-text"><?php echo $beerDesc ?></p>
                </a>    
                
            <?php
            $countBeer++;     
             } 
                   
            $queryBeer->close();
            ?>

        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="list-group">
            <a href="./breweries.php" class="list-group-item active">
            <h3 class="list-group-item-heading">Highest Rated Breweries</h3>
            </a>
            
            <?php
          $countBrewery = 1;
            while($queryBrewery->fetch() && $countBrewery < 6) {
                ?>
                <a href="./brewery.php?id=<?php echo $breweryID?>"" class="list-group-item active">
                <h3 class="list-group-item-heading"><?php echo $countBrewery ?>.&nbsp;<?php echo $breweryName ?></h3>
                   <?php if ($avgBeerRating < 1.5) {
                   ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span>
                    </p>
                    
                    <?php
                }
                    else if ($avgBreweryRating >= 1.5 && $avgBreweryRating < 2.5) {
                         ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                 </p>
                    <?php
                }
                       else if ($avgBreweryRating >= 2.5 && $avgBreweryRating < 3.5) {
                            ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($avgBreweryRating >= 3.5 && $avgBreweryRating < 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($avgBreweryRating >= 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
            
            ?>
       
                <p class="list-group-item-text"><?php echo $breweryDesc ?></p>
                </a>    
            
                
            <?php
            $countBrewery++;     
             } 
                   
            $queryBrewery->close();
   
            ?>
        </div>
    </div>
    
</div>





<?php require_once("master_bottom.php"); ?>