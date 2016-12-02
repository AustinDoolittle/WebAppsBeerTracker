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
    $id = (int)$_GET["id"];
    $query = $conn->prepare("SELECT be.ID, be.Name, be.Brewery, ty.Name, br.Name, be.Proof, be.Format, be.Description, be.ImagePath FROM Beers be, Breweries br, Types ty WHERE be.Brewery = br.ID AND ty.ID = be.Type AND be.ID = ?");
    $query->bind_param('i', $id);
    $query->execute();
    $query->bind_result($beer_id, $beer_name, $brewery_id, $type, $brewery, $proof, $format, $desc, $img);
    
    
    if(!$query->fetch()) {
        die("This beer was not found");
    }
    $query->close();
    
    $queryAvgRating = $conn->prepare("SELECT AVG(r.Rating) FROM Rating r JOIN Beers be ON (r.Beer = be.ID) WHERE be.ID = ?");
    $queryAvgRating->bind_param('i', $id);
    $queryAvgRating->execute();
    $queryAvgRating->bind_result($avgRating);
    
       if(!$queryAvgRating->fetch()) {
        die("This beer was not found");
    }
    $queryAvgRating->close();



?>

    <h2> <?php echo $beer_name ?></h2>
    <h4><?php echo $brewery ?></h4>
    <span>Average Rating<?php if ($avgRating < 1.5) {
                   ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span>
                    </p>
                    
                    <?php
                }
                    else if ($avgRating >= 1.5 && $avgRating < 2.5) {
                         ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                 </p>
                    <?php
                }
                       else if ($avgRating >= 2.5 && $avgRating < 3.5) {
                            ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($avgRating >= 3.5 && $avgRating < 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($avgRating >= 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
            
            ?></span>

<div class="container">
    <div class="row center-text">
                <div class="col-xs-3">
                   <h3>Rating</h3>
                </div>
                <div class="col-xs-3">
                   <h3>Review</h3>
                </div>
                <div class="col-xs-3">
                    <h3>Image</h3>
                </div>
                   <div class="col-xs-3">
                    <h3>User</h3>
                </div>
            </div>    
    
    <?php
        $query = $conn->prepare("SELECT rv.Review, rv.Rating, rv.ImagePath, us.Name, us.ID FROM Rating rv, Users us WHERE rv.Beer = ? AND rv.User = us.ID");
        $query->bind_param("i", $id);
        $query->execute();
        $query->bind_result($review, $rating, $img, $username, $user_id);
        while($query->fetch()) {
            ?>
            <div class="row">
                <div class="col-xs-3">
                    <?php if ($rating < 1.5) {
                   ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span>
                    </p>
                    
                    <?php
                }
                    else if ($rating >= 1.5 && $rating < 2.5) {
                         ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                 </p>
                    <?php
                }
                       else if ($rating >= 2.5 && $rating < 3.5) {
                            ?> <p class="list-group-item-text">
                   <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($rating >= 3.5 && $rating < 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
                       else if ($rating >= 4.5) {
                            ?> <p class="list-group-item-text">
                    <span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span><span><img src="Images/Index/yellowStar.png" alt="star"><span>
                   </p>
                    <?php
                }
            
            ?>
                </div>
                <div class="col-xs-3">
                   <p>"<?php echo $review ?>"</p>
                </div>
                <div class="col-xs-3">
                    <?php if($img != '') {
                        ?>
                        <img src='/Images/Ratings/<?php echo $img ?>' width="100px"/>
                        <?php
                    } 
                    else { ?>
                        <p>N/A</p>
                    <?php } ?>
                </div>
                   
                   <div class="col-xs-3">
                    <?php echo $username ?>
                </div>
            </div>
            <?php
        }
    ?>
    </div>
</div>



<?php include_once("master_bottom.php");?>