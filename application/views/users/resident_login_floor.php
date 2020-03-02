<?php

$valueSaved=array();

foreach ($Level as $key => $value){
    array_push($valueSaved,$value['Level']);
}
sort($valueSaved);
?>
<body>
<img id="background_img" src="<? echo base_url(); ?>assets/images/wp2.jpg" style='position:fixed;top:0px;left:0px;width:100vw;height:100%;z-index:-1;opacity: 0.5;'>
<div id="content">
    <div id="main">
        <h1><?=$floor?></h1>
        <br>
        <div id="choice">
            <?php
            foreach($valueSaved as $value){
                echo "<button value='$value' class='button2' onclick='myFunction(this)'> $value</button>";
            }
            ?>
        </div>
        <br><br>
        <div id="button">
            <form method="post" action="<? echo base_url(); ?>Users/login_resident/resident_login_room">
                <input disabled class="button2" type="submit" value="<?=$confirm?>" />
                <input type="hidden" name="level" value="no value">
            </form>
        </div>
        <br>
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
        window.location.href = base_url + "Users/login_resident";
    }
</script>
</html>


