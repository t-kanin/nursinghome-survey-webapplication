<?php

$valueSaved=array();
$level=$Level; //Level with capital letter is from controller, so don`t be confusedhhh
//more than one room
$more_than_one_room=$this->session->userdata('MTOR');
if($more_than_one_room==0){
    $this->session->set_userdata('MTOR',1);
    header("Location: ".base_url()."Users/login_resident/resident_login_floor");
    exit();
}

foreach ($Room as $key => $value){
    array_push($valueSaved,$value['Room']);
}
sort($valueSaved);

if (count($valueSaved)==1){
    $this->session->set_userdata("MTOR",0);
    foreach($valueSaved as $value){
        $this->session->set_userdata(Array("Room"=>$value));
    }

    header("Location: ".base_url()."Users/login_resident/resident_login_name");
    exit();
}

?>

<body>
<img id="background_img" src="<? echo base_url(); ?>assets/images/wp2.jpg" style='position:fixed;top:0px;left:0px;width:100vw;height:100%;z-index:-1;opacity: 0.5;'>
<div id="content">
    <div id="main">
        <h1><?=$room?></h1>
        <br>
        <div id="choice">
            <?php
            foreach($valueSaved as $value){
                echo "<button value='$value' class='button2' onclick='myFunction(this)'> $value</button>";
            }
            ?>
        </div>
        <br>
        <div id="button">
            <form method="post" action="<? echo base_url(); ?>Users/login_resident/resident_login_name">
                <input disabled class="button1" type="submit" value="<?=$confirm?>" />
                <input type="hidden" name="room" value="no value">
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
    }
    function goBack() {
        window.location.href = base_url + "Users/login_resident/resident_login_floor";
    }
</script>
</html>
