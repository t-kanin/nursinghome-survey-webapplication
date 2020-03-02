<div class="form-group pull-right">
    <button type="submit" id="register" class="btn-register">Save Changes</button>
</div>
    <div>
        <button type="button" class = "reset_pass" id ="{IdResident}" style="background-color: #E2CFD3; margin-top: 10px">
            Reset Password
        </button>
    </div>
    <?php echo form_close(); ?>
</div>
    <script>
        $(document).ready(function() {
            $('.reset_pass').click(function () {
                var Id = this.id;
                console.log(Id);
                $.ajax({
                    url: base_url+'PageController/resident_reset_password',
                    method: "POST",
                    data:{
                        Id:Id
                    },
                    success: function (msg) {
                        if(msg=="success")
                            location.reload();
                    }
                })
            });
        });
    </script>
</article>
