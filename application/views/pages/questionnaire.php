<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
 <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- <textarea id="category-box" rows="1">Category: Nursing Home</textarea> -->
            Categorie: Extra
        </div>
    </div>
    <?php echo form_open('PageController/add_question'); ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p style="margin-top:30px; margin-bottom: 5px;">Nederlands</p>
                <textarea class="form-control rounded-0" id="content_NL"  name ='content_NL'rows="10" style="resize: none; height: 60px;" placeholder="Typ hier uw nieuwe vraag in het Nederlands"></textarea>
                <p style="margin-top:30px; margin-bottom: 5px;">Engels</p>
                <textarea class="form-control rounded-0" id="question-box"  name ='content_EN'rows="10" style="resize: none; height: 60px;" placeholder="Typ hier uw nieuwe vraag in het Engels"></textarea>
                <p style="margin-top:30px; margin-bottom: 5px;">Frans</p>
                <textarea class="form-control rounded-0" id="question-box"  name ='content_FR'rows="10" style="resize: none; height: 60px;" placeholder="Typ hier uw nieuwe vraag in het Frans"></textarea>
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
