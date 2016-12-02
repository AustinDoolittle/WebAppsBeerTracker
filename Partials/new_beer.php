<?php //get breweries
    include_once 'db_connect.php';
    $conn = db_connect();
    
    $query = $conn->prepare("SELECT ID, Name FROM Breweries");
    
    $query->execute();
    
    $query->bind_result($id, $name);

?>

<div id="new_beer" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Beer</h4>
            </div>
            <div class="modal-body">
                <form action="./Controllers/Beers/new.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="txtName">Name:</label>
                        <input type="text" id="txtName" name="name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="txtFileUpload">File:</label>
                        <div class="row" id="txtFileUpload"></div>
                        <div class="col-xs-8"><span class="form-control" id="beerFilename"></span></div>
                        <div class="col-xs-4">
                            <label class="btn btn-default btn-file">
                            Browse<input id="upBeerFile" type="file" style="display:none;" name="file" accept=".png,.jpg,.jpeg,.gif"/>
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">
                        <label for="ddlBreweries">Brewery:</label>
                        <select id="ddlBreweries" name="brewery" class="form-control">
                            <?php while($query->fetch()) {
                                ?>
                                <option value='<?php echo $id ?>'><?php echo $name ?></option>
                                <?php
                            }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtProof">Proof:</label>
                        <input type="text" class="form-control" id="txtProof" name="proof"/>
                    </div>
                    <div class="form-group">
                        <label for="txtSeason">Season:</label>
                        <input type="text" name="season" class="form-control" id="txtSeason"/>
                    </div>
                    <div class="form-group">
                        <label for="txtFormat">Format (Bottle, Tap, etc):</label>
                        <input type="text" name="format" class="form-control" id="txtFormat"/>
                    </div>
                    <div class="form-group">
                        <label for="txtDesc">Description:</label>
                        <input type='textarea' name="desc" id="txtDesc" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="ddlType">Type:</label>
                        <select id="ddlType" name="type" class="form-control">
                            <?php 
                            $query->close();
                            $query = $conn->prepare("SELECT Name, ID FROM Types");
                            $query->execute();
                            $query->bind_result($name, $id);
                            while($query->fetch()) {
                                ?>
                                <option value="<?php echo $id?>"><?php echo $name?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary"></input>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var validate = function() {
        var name, proof, season, format;
        name = $('.txtName').val();
        proof = $('txtProof').val();
        season = $('txtSeason').val();
        format = $('.txtFormat').val();
        
        if(name.trim() == '') {
            alert("You must have a name for this beer");
            return false;
        }
        else if(proof.trim() == "" || isNaN(proof)) {
            alert("You must enter a valid proof for this beer");
            return false;
        }
        else if(season.trim() == "") {
            alert("You must enter a season for this beer");
            return false;
        }
        else if(format.trim() == "") {
            alert("You must specify the format this beer is served in");
            return false;
        }
        return true;
    };
    
    $(function() {
       $('#upBeerFile').change(function() {
           var filename = $(this).val();
           $('#beerFilename').text(filename.replace(/^.*[\\\/]/, ''));
       });
    });
    
</script>

<?php 
    $query->close();
    $conn->close();
?>