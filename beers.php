<?php require_once('master_top.php'); 
include  $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';

$conn = db_connect();

if($conn == NULL) {
          die("There was an error connecting to the database");
}

$query = $conn->prepare("SELECT be.ID, be.Name, be.Description, be.Proof, be.Season, be.Format, be.ImagePath,  br.Name, ty.Name FROM Beers be, Breweries br, Types ty WHERE be.Brewery = br.ID AND be.Type = ty.ID");
$query->execute();
$query->bind_result($beer_id, $name, $desc, $proof, $season, $format, $img,  $brewery, $type);
          
?>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <?php if(isset($_GET["success"])) {
            if($_GET["success"] == "true") {
            ?><div class="alert alert-success"><strong>Success!</strong> You added a new beer</div><br/><?php
            }
            else if($_GET["success"] == "rate") {
            ?><div class="alert alert-success"><strong>Success!</strong> You added a new rating</div><br/><?php
            }
        } 
        if(isset($_GET["error"])) {
            if($_GET["error"] == "rate_unknown") {
                ?><div class="alert alert-warning"><strong>Alert!</strong> There was an error submitting your rating</div><br/><?php
            }
        }
        if ($_SESSION["logged_in"]) {?>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#new_beer">
          New Beer
        </button>
        <?php } ?>
    </div>
</div>


<div class="container">
  <?php
        while($query->fetch()) {
    ?>
        <div class="row row-eq-height">
            <div class="col-md-3">
                <h3><?php echo $name ?></h3>
                <h4><?php echo $brewery ?></h4>
                <?php echo "Proof: ". number_format($proof, 2) ?><br/>
                <?php echo "Season: ".$season ?><br/>
                <?php echo "Type: ". $type ?> <br/>
                <?php echo "Format: ". $format ?> <br/>
            </div>
            
            <div class="col-md-6 desc flex-center">
            <p><?php echo $desc ?><br/></p>
            <?php
                if($img != '') { ?>
                    <img src="/Images/Beers/<?php echo $img?>" width="100px"/>
            <?php } ?>
            </div>
            
            <div class="col-md-3 flex-center">
                
             
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
    require_once('Partials/new_beer.php');
    require_once('Partials/new_rating.php');
}
require_once('master_bottom.php');?>