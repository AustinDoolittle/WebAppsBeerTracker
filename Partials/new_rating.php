<div id="new_rating" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rate this Beer</h4>
            </div>
            <div class="modal-body">
                <form name="newRating" action="./Controllers/Ratings/new.php" method="post" enctype="multipart/form-data" id="newRating" onsubmit="return check()">
                    <div class="form-group">
                        <h5><span id="lblModalName"></span></h5>
                    </div>
                    <div class="form-group">
                        <h6><span id="lblModalBrewery"></span></h6>
                    </div>
                    <div class="form-group row">
                                <label for="ddlModalRating" class="col-sm-2 col-form-label">Rating:</label>
                                <div class="col-sm-4">
                                    <select class="form-control " name="rating" id="ddlModalRating"></select>
                                </div>
                            </div>
                    <div class="form-group">
                        <label for="txtModalReview">Review:</label>
                        <textarea class="form-control" name="review" id="txtModalReview"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtFileUpload">File:</label>
                        <div class="row" id="txtFileUpload"></div>
                        <div class="col-xs-8"><span class="form-control" id="ratingFilename"></span></div>
                        <div class="col-xs-4">
                            <label class="btn btn-default btn-file">
                            Browse<input id="upRatingFile" type="file" style="display:none;" name="file" accept=".png,.jpg,.jpeg,.gif"/>
                        </label>
                        </div>
                    </div>
                    <input type="hidden" id="hdModalBeer" name="beer" />
                    <input type="submit" class="btn btn-primary"/>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var beer_name, brewery_name, beer_id;
    $(function() {
        populateDropDown();
        $('#new_rating').on('show.bs.modal', function(e) {
            $('#lblModalBrewery').text(brewery_name);
            $('#lblModalName').text(beer_name);
            $('#hdModalBeer').val(beer_id);
        });
        
       $('#upRatingFile').change(function() {
           var filename = $(this).val();
           $('#ratingFilename').text(filename.replace(/^.*[\\\/]/, ''));
       });
    });
    
    var populateDropDown = function() {
        var ddl = $('#ddlModalRating');
        for(var i = 1; i <= 5; i++) {
            var opp = $('<option>');
            opp.val(i);
            opp.html(i);
            ddl.append(opp);
        }
    };
    var check = function()
            {
                // if (!newBeer.name.value)
                // {
                //     alert ("Please Enter a Name");
                //     return (false);
                // }
                // if (!newBeer.brewery.value)
                // {
                //     alert ("Please Enter a Brewery");
                //     return (false);
                // }
                //  if (!newBeer.proof.value)
                // {
                //     alert ("Please Enter a Proof");
                //     return (false);
                // }
                return (true);
            }

    var setRatingAttributes = function(brewery, beer, id) {
        beer_name = beer;
        brewery_name = brewery;
        beer_id = id;
    }
    
    
</script>
