<?php if($this->session->flashdata('caregiver_registered')):?>
    <?php echo '<p class = "alert alert-success">'.$this->session->flashdata('caregiver_registered').'</p>'?>
<?php endif; ?>
<script src="<?php echo base_url(); ?>assets/js/md5.js"></script>
<div class="container-login100">
    <div class="col-sm-4">

        <div class="login100-form validate-form">
					<span class="login100-form-title">
						Verzorger Login
					</span>
            <div class="error_handler">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                <input id='email' class="input100" type="text" value ="{Email}" name="email" placeholder="Email">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="material-icons" aria-hidden="true">email</i>
						</span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Wachtwoord is vereist">
                <input id="password" class="input100" type="password" name="password" placeholder="Wachtwoord">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="material-icons" aria-hidden="true">lock</i>
						</span>
            </div>
            <div id='submitButton' class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>

            <script>
                let submitButton=document.getElementById('submitButton');
                function submit()
                {
                    let emailElement=document.getElementById('email');
                    let pwElement=document.getElementById('password');

                    let form1 = document.createElement("form");
                    form1.id = "form1";
                    form1.name = "form1";
                    document.body.appendChild(form1);


                    let input1 = document.createElement("input");
                    input1.type = "hidden";
                    input1.name = "email";
                    input1.value = emailElement.value;
                    form1.appendChild(input1);

                    let input2=document.createElement("input");
                    input2.type = "hidden";
                    input2.name = "password";
                    input2.value= hex_md5(pwElement.value);
                    form1.appendChild(input2);

                    form1.method = "POST";
                    form1.action = 'login_caregiver'; //If this not work, try User/login_caregiver

                    form1.submit();
                    document.body.removeChild(form1);
                }
                submitButton.addEventListener('click',submit);
            </script>

            <div class="text-center p-t-136">
                <button class="button2Clicked" id="create" type="button" onclick="location.href='<?php echo base_url(); ?>Users/register_caregiver'">
                    Maak Een Account
                </button>
            </div>
        </div>
    </div>
    <!-- offset -->
    <div class="col-sm-8"></div>

</div>
</body>
</html>





