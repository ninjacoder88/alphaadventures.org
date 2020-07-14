<!doctype html>
<?php function RenderBody() { ?>
    <div class="row">
        <div class="col-md-4">
            <p>Do you have an activity you think would be fun and have broad appeal?</p>
            <div class="form-group">
                <textarea rows="10" class="form-control" placeholder="Suggest an activity and provide any details"></textarea>
            </div>
            <button type="button" class="btn btn-primary">Submit</button>
        </div>
    </div>
<?php } ?>

<?php include("_layout.php"); ?>