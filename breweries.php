<?php require_once("master_top.php") 
include 'db_connect.php';

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

$query = $conn->prepare("SELECT Name, Address, Description, WebsiteUrl FROM Breweries");
$query->bind_result($name, $address, $desc, $url);
?>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#new_brewery">
          Launch demo modal
        </button>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <?php
            while($query->fetch()) {
                ?>
                <div class="row">
                    <div class="col-xs-3">
                        <?php echo $name ?>
                    </div>
                    <div class="col-xs-3">
                        <?php echo $address ?>
                    </div>
                    <div class="col-xs-3">
                        <?php echo $desc ?>
                    </div>
                    <div class="col-xs-3" >
                        <?php echo $url ?>
                    </div>
                </div>
            <?php
            }
            ?>
    </div>
</div>
<?php require_once("./Partials/new_brewery.php");
<?php require_once("master_bottom.php") ?>
