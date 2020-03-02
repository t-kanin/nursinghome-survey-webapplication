<?php
//data from controller
$more_than_one_name=$this->session->userdata('MTON');
if($more_than_one_name==0){
    $this->session->set_userdata('MTON',1);
    header("Location: ".base_url()."Users/login_resident/resident_login_room");
    exit();
}

$level=$Level;
$room=$Room;
$firstNames=array();
$lastNames=array();
foreach ($Firstnames as $key => $value){
    array_push($firstNames,$value);
}
foreach ($Lastnames as $key => $value){
    array_push($lastNames,$value);
}

if (count($firstNames)==1){
    $this->session->set_userdata('MTON',0);
    foreach ($Firstnames as $key => $value){
        $this->session->set_userdata('FirstName',$value);
    }
    foreach ($Lastnames as $key => $value){
        $this->session->set_userdata('LastName',$value);
    }
    header("Location: ".base_url()."Users/residentPassword");
    exit();
}

?>
<body>
<img id="background_img" src="<? echo base_url(); ?>assets/images/wp2.jpg" style='position:fixed;top:0px;left:0px;width:100vw;height:100%;z-index:-1;opacity: 0.5;'>
<div id="content">
    <div id="main">
        <h1><?=$name?></h1>
        <br>
        <div id="choice">
            <?php
            for($i=0;$i<count($firstNames); $i++){
                echo "<button value='$firstNames[$i]' name='$lastNames[$i]' class='button2' onclick='myFunction(this)'> $firstNames[$i] $lastNames[$i]</button>";
            }
            ?>
        </div>
        <br>
        <div id="button">
            <form method="post" action="<? echo base_url(); ?>Users/residentPassword">
                <input disabled class="button1" type="submit" value="<?=$confirm?>" />
                <input type="hidden" name="firstName" value="no value">
                <input type="hidden" name="lastName" value="no value">
                <input type="hidden" name="room" value=<? echo $room?>>
                <input type="hidden" name="level" value=<? echo $level?>>
            </form>
        </div>
        </br>
    </div>
</div>
</body>
<script>
    function myFunction(id) {
        var choices= document.getElementById("choice").children;
        for(var i=0;i<choices.length;i++) {
            choices[i].className = "button2";
        }
        id.className="button2Clicked noHover";
        document.getElementById("button").children[0].children[0].className="button2Clicked";
        document.getElementById("button").children[0].children[0].disabled=false;
        document.getElementById("button").children[0].children[1].value=id.value;
        document.getElementById("button").children[0].children[2].value=id.name;
    }
    function goBack() {
        window.location.href = base_url + "Users/login_resident/resident_login_room";
    }
</script>
</html>
