<div id="new_brewery" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Brewery</h4>
            </div>
            <div class="modal-body">
                <form action="./Controllers/Breweries/new.php" method="post" enctype="multipart/form-data" onsubmit="return validate()">
                    <div class="form-group">
                        <label for="txtName">Name:</label>
                        <input type="text" id="txtName" name="name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="txtFileUpload">File:</label>
                        <div class="row" id="txtFileUpload"></div>
                        <div class="col-xs-8"><span class="form-control" id="breweryFilename"></span></div>
                        <div class="col-xs-4">
                            <label class="btn btn-default btn-file">
                            Browse<input id="upBreweryFile" type="file" style="display:none;" name="file" accept=".png,.jpg,.jpeg,.gif"/>
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtAddress">Address:</label>
                        <input type="textarea" name="address" id="txtAddress" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="txtDesc">Description:</label>
                        <input type="textarea" name="desc" id="txtDesc" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="txtWebsite">Website Url:</label>
                        <input type="text" id="txtWebsite" name="url" class="form-control"/>
                    </div>
                    <input type="submit" class="btn btn-primary"></input>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var validate = function() {
        var name, address, desc, website;
        name = $('.txtName').val();
        desc = $('.txtDesc').val();
        website = $('.txtWebsite').val();
        
        if(name.trim() == '') {
            alert("You must enter the name of the brewery");
            return false;
        }
        
        if(desc.trim() == '') {
            alert("You must enter a description of the brewery");
            return false;
        }
        
        if(website.trim() == '') {
            alert("You must enter a website url");
            return false;
        }
        
        return true;
    };
    
    $(function() {
        $('#upBreweryFile').change(function() {
           var filename = $(this).val();
           $('#breweryFilename').text(filename.replace(/^.*[\\\/]/, ''));
       });
    });
</script>