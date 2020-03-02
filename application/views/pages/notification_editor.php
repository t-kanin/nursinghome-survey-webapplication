 <!--<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <textarea id="category-box" rows="1">Notification:</textarea>
        </div>
    </div>  -->
    <?php echo form_open('PageController/add_notification'); ?>
 <img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <textarea class="form-control rounded-0" name="question-box" id="question-box" rows="10" placeholder="Typ hier uw notificatie" maxlength="500" style="resize: none;"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="error_handler col-md-3"></div>

        <?php if (validation_errors()) { ?>
            <div class = "alert alert-danger col-md-6 ">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <button type="submit" id="submit-feedback"><strong>Bewaar</strong></button>
        </div>
    </div>
    <br>
    <?php form_close() ?>

</div>
</body>
</html>
