<div class="col-md-4 col-md-offset-4">
<h3>Beer Rating</h3>
<form name="newBeer" action="./Controllers/Ratings/new.php" method="post" id="newBeer" onsubmit="return check()">
    <div class="form-group">
        <label for="txtName">Name:</label>
        <input class="form-control" type="text" name="name" id="txtName"/>
    </div>
    <div class="form-group">
        <label for="txtBrewery">Brewery:</label>
        <input class="form-control" type="text" name="brewery" id="txtBrewery"/>
    </div>
     <div class="form-group">
        <label for="txtproof">Proof:</label>
        <input class="form-control" type="text" name="proof" id="txtProof"/>
    </div>
    <div class="form-group row">
                <label for="ddlRating" class="col-sm-2 col-form-label">Rating:</label>
                <div class="col-sm-4">
                    <select class="form-control " name="rating" id="ddlRating"></select>
                </div>
            </div>
    <div class="form-group">
        <label for="txtSeason">Season:</label>
        <input class="form-control" type="text" name="season" id="txtSeason"/>
    </div>
    <div class="form-group">
        <label for="txtFormat">Format:</label>
        <input class="form-control" type="text" name="format" id="txtFormat"/>
    </div>
    <div class="form-group">
        <label for="txtDescription">Description:</label>
        <input class="form-control" type="text" name="description" id="txtDescription"/>
    </div>
    <input type="submit" class="btn btn-primary"/>
</form>
</div>

<script>
$(function() {
        populateDropDown();
    });
    
    var populateDropDown = function() {
        var ddl = $('#ddlRating');
        for(var i = 1; i <= 5; i++) {
            var opp = $('<option>');
            opp.val(i);
            opp.html(i);
            ddl.append(opp);
        }
    };
    function check()
            {
                if (!newBeer.name.value)
                {
                    alert ("Please Enter a Name");
                    return (false);
                }
                if (!newBeer.brewery.value)
                {
                    alert ("Please Enter a Brewery");
                    return (false);
                }
                 if (!newBeer.proof.value)
                {
                    alert ("Please Enter a Proof");
                    return (false);
                }
                return (true);
            }

</script>