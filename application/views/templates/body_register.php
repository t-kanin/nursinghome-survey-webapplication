<script>
    var base_url = "<?php echo base_url();?>";
</script>
<article class="card-body mx-auto">
    <h3 class="card-title mt-3 text-center"> {title}</h3>
    <div class="error_handler">
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
    </div>
    <?php if($this->session->tempdata('reset_pass_success')):?>
        <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('reset_pass_success').'</p>'?>
    <?php endif; ?>
    <?php echo form_open('Users/{function}'); ?>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">home</i></span>
        </div>
        <input type="text" name="level" class="form-control" id="level" value="{level}" placeholder="Geef uw verdieping aan" >
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">home</i></span>
        </div>
        <input type="text" name="room" class="form-control" id="room"  value="{room}"placeholder="Geef uw kamernummer aan">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">account_box</i></span>
        </div>
        <input type="text" name="name" class="form-control" id="name" value="{name}" placeholder="Geef uw naam in">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">account_box</i></span>
        </div>
        <input type="text" name="lastname" class="form-control" id="lastname" value="{lastname}"placeholder="Geef uw achternaam in">
    </div>