<div id="new_brewery" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Brewery</h4>
            </div>
            <div class="modal-body">
                <form action="/Controllers/Breweries/new.php" action="post" onsubmit="return validate()">
                    <div class="form-group">
                        <label for="txtName">Name:</label>
                        <input type="text" id="txtName" name="name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="txtFile">File (temporary):</label>
                        <input type="text" id="txtFile" name="file" class="form-control"/>
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
                    <submit class="btn btn-primary"></submit>
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
    }
</script>