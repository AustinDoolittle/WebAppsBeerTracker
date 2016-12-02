<?php include_once("master_top.php");
    include_once("db_connect.php");
    if(!isset($_GET["id"])) {
        header("Location: /breweries.php");
        exit(1);
    }

    $conn = db_connect();
    if($conn == NULL) {
        die("Error connecting to database");
    }
    
    $query = $conn->prepare("SELECT Name, Longitude, Latitude, Address, ImagePath, Description, WebsiteUrl FROM Breweries WHERE ID = ?");
    $id = (int)$_GET["id"];
    $query->bind_param("i", $id);
    $query->execute();
    $query->bind_result($name, $long, $lat, $addr, $img, $desc, $url);
 
    if(!$query->fetch()) {
        die("This brewery does not exist");
    }
    $query->close();
    
    $queryAvgBreweryRating = $conn->prepare("SELECT AVG(r.Rating) FROM Rating r JOIN Beers be ON (r.Beer = be.ID) JOIN Breweries br ON (be.Brewery = br.ID) WHERE br.ID = ?");
    $queryAvgBreweryRating->bind_param('i', $id);
    $queryAvgBreweryRating->execute();
    $queryAvgBreweryRating->bind_result($avgBreweryRating);
    
       if(!$queryAvgBreweryRating->fetch()) {
        die("This beer was not found");
    }
    $queryAvgBreweryRating->close();
    
    ?>
    <span class="container text-center"><h1><?php echo $name ?></h1></span>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 center-text">
          <?php if ($avgBreweryRating < 1.5) {
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
          <?php 
                echo $addr.'<br/>';
                echo $img.'<br/>';
                echo $desc.'<br/><br/>';
                echo $url.'<br/>';
                ?>
        </div>
    </div>

    
    <div class="container">
  <?php
            $query = $conn->prepare("SELECT be.ID, be.Name, be.Description, be.Proof, be.Season, be.Format, be.ImagePath, ty.Name FROM Beers be,  Types ty WHERE be.Brewery = ? AND be.Type = ty.ID");
            $query->bind_param("i", $_GET["id"]);
            $query->execute();
            $query->bind_result($beer_id, $beer_name, $desc, $proof, $season, $format, $img, $type);
        while($query->fetch()) {
    ?>
        <div class="row row-eq-height">
            <div class="col-md-3">
                <h3><?php echo $beer_name ?></h3>
                <?php echo "Proof: ". number_format($proof, 2) ?><br/>
                <?php echo "Season: ".$season ?><br/>
                <?php echo "Type: ". $type ?> <br/>
                <?php echo "Format: ". $format ?> <br/>
            </div>
            
            <div class="col-md-6 desc flex-center">
            <p><?php echo $desc ?><br/></p>
            </div>
            
            <div class="col-md-3 flex-center">
                <?php
                if($img != '') { ?>
                    <img src="/Images/Beers/<?php echo $img?>" width="100px"/>
            <?php } ?>
             
            <?php 
                if ($_SESSION["logged_in"]) { ?>
                    <button type="button" class="btn btn-primary btn-sm" onclick="setRatingAttributes('<?php echo $brewery?>', '<?php echo $name?>', <?php echo $beer_id?> )" data-toggle="modal" data-target="#new_rating" >
                        New Rating
                    </button>
            <?php } ?>
             <a class="btn btn-default btn-sm" href="beer.php?id=<?php echo $beer_id ?>">View Ratings</a>
  
            </div>

        </div>
    <?php
        }
        $query->close();
        $conn->close();
    ?>
</div>
    
    
    
    
    
    
    
<?php 
if($_SESSION["logged_in"]) {
    require_once('Partials/new_rating.php');
}
include_once("master_bottom.php"); ?>