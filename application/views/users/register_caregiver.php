<article class="card-body mx-auto">
    <div class="login100-form-title">Registreer verzorgers</div>
    <div class="error_handler">
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
    </div>
    <?php echo form_open('users/register_caregiver'); ?>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">account_box</i> </span>
        </div>
        <input type="text" value="{name}" name="name" class="form-control" id="name" placeholder="Voornaam">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">account_box</i> </span>
        </div>
        <input type="text" value="{lastname}" name="lastname" class="form-control" id="lastname" placeholder="Achternaam">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">email</i> </span>
        </div>
        <input type="text" value="{email}" name="email" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">lock</i> </span>
        </div>
        <input type="password" name="password" class="form-control" id="password" placeholder="Wachtwoord">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">lock</i></span>
        </div>
        <input type="password" name="confirm_password" class="form-control" id="confirm-password"
               placeholder="Bevestig wachtwoord">
    </div>
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="material-icons">home</i> </span>
        </div>
        <input type="text" name="nursing_home" class="form-control" id="nursing-home"
               placeholder="Woonzorgcentrum">
    </div>
    <div>
        <select name="language"  id="language" style="min-width:100%">
            <option value="dutch">Dutch</option>
            <option value="French">French</option>
            <option value="English">English</option>
        </select>
    </div>

    <div class="form-group pull-right">
        <button type="submit" id="register" class="btn-register" style="margin-top: 15px">Registreer</button>
    </div>
    <?php echo form_close(); ?>
    <p>Ben je al geregistreerd? <a href="<?php echo base_url(); ?>Users/login_caregiver">Klik hier om in te loggen</a>
    </p>
</article>
</div>
</body>
</html>

