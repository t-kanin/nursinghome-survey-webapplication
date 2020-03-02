<?php
$firstName=$Firstname;
$lastName=$Lastname;
$userState=$IsRegistered;
$Choose_4=$choose_4;
$No_match=$no_match;
$Incorrect=$incorrect;
$level=$this->session->userdata('Level');
$room=$this->session->userdata('Room');
if($userState==0){
    $header=$choose;
}
else if($userState==1){
    $header=$confirm_password;
}
else{
    $header=$press;
}
$sql = "SELECT IdResident FROM a19ux3.Resident WHERE Level=".$level." AND Room=".$room." AND firstName='".$firstName."' AND lastName='".$lastName."';";
$result = $this->db->query($sql);
$this->session->set_userdata('id',($result->result())[0]->IdResident);
$id=$this->session->userdata('id');
$sql="SELECT Language FROM a19ux3.Resident WHERE IdResident=$id;";
$result = $this->db->query($sql);
if ($result->num_rows() > 0) {
    $this->session->set_userdata('language_resident',($result->result())[0]->Language);
    if($this->session->userdata('language_resident')==null){
        $this->session->set_userdata('language_resident',"Dutch");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resident Login</title>
    <link rel="stylesheet" href="<? echo base_url(); ?>assets/css/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script> var base_url = "<?php echo base_url();?>";</script>
    <script>let choose_4="<?php echo $Choose_4?>";</script>
    <script>let no_match="<?php echo $No_match?>"</script>
    <script>let incorrect="<?php echo $Incorrect?>"</script>
    <script src="<? echo base_url(); ?>assets/js/Jquery-2.2.2.js" type="text/javascript"></script>
    <script src="<? echo base_url(); ?>assets/js/md5.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="left">
    <h1 id="header1">
        <? echo $header ?>
    </h1>
    <div class="username-input">

        <input type="hidden" id="firstname" placeholder="firstname" type="text" value=<? echo $firstName ?>>
        <br>
        <input type="hidden" id="lastname" placeholder="lastname" type="text" value=<? echo $lastName ?>>
        <br>
        <input  type="hidden" id="userstate" placeholder="" type="text" value=<? echo $userState ?>>
        <br>
        <input type="hidden" id="pw" type="text" value="">

    </div>
    <div id="img-container" class="grid-container">
        <!-- make it smart not hard code later, otherwise not safe since can be seen on browser-->
        <span><img id="img1" name=1575016321.jpg src="<? echo base_url(); ?>assets/password/1575016321.png"></span>
        <span><img id="img2" name=1575016359.jpg src="<? echo base_url(); ?>assets/password/1575016359.png"></span>
        <span><img id="img3" name=1575016560.jpg src="<? echo base_url(); ?>assets/password/1575016560.png"></span>
        <span><img id="img4" name=1575016567.jpg src="<? echo base_url(); ?>assets/password/1575016567.png"></span>
        <span><img id="img5" name=1575016576.jpg src="<? echo base_url(); ?>assets/password/1575016576.png"></span>

        <span><img id="img6" name=1575016590.jpg src="<? echo base_url(); ?>assets/password/1575016590.png"></span>
        <span><img id="img7" name=1575016614.jpg src="<? echo base_url(); ?>assets/password/1575016614.png"></span>
        <span><img id="img8" name=1575016652.jpg src="<? echo base_url(); ?>assets/password/1575016652.png"></span>
        <span><img id="img9" name=1575016660.jpg src="<? echo base_url(); ?>assets/password/1575016660.png"></span>
        <span><img id="img10" name=1575016924.jpg src="<? echo base_url(); ?>assets/password/1575016924.png"></span>

        <span><img id="img11" name=1575016666.jpg src="<? echo base_url(); ?>assets/password/1575016666.png"></span>
        <span><img id="img12" name=1575016674.jpg src="<? echo base_url(); ?>assets/password/1575016674.png"></span>
        <span><img id="img13" name=1575016683.jpg src="<? echo base_url(); ?>assets/password/1575016683.png"></span>
        <span><img id="img14" name=1575016691.jpg src="<? echo base_url(); ?>assets/password/1575016691.png"></span>
        <span><img id="img15" name=1575016903.jpg src="<? echo base_url(); ?>assets/password/1575016903.png"></span>

    </div>
    <text id="error_message" style="display:none;">Error</text>
    <div class="div-around-button">
        <button id="submit" class="confirm-button"><?=$confirm?></button>
    </div>

</div>
<div class="right">

    <button onclick="endSurvey('<?echo base_url()?>Users/index/')" class="side-button"><i class="material-icons" style="font-size: 45px">home</i><br><?= $end_the_survey?></button>
    <button onclick="goBack()" class="side-button"><i class="material-icons" style="font-size: 45px">arrow_back</i><br><?= $go_back?></button>
</div>
</body>
<script src="<? echo base_url(); ?>assets/js/UserLogin.js" type="text/javascript"></script>
<script src="<? echo base_url(); ?>assets/js/navigation.js" type="text/javascript"></script>
</html>
<script>
    function goBack() {
        window.location.href = base_url + "Users/login_resident/resident_login_name";
    }

</script>