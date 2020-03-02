<?
if(isset($_POST['questionNumber']))
{
    $this->session->set_userdata('questionNumber',$_POST['questionNumber']);
}
$questionNumber=$this->session->userdata('questionNumber');
$continuePossible=$this->session->userdata('continuePossible');
$language=$this->session->userdata('language_resident');

//total data
$sql="SELECT IdCategory FROM a19ux3.Question";
$result = $this->db->query($sql);
$total_data= $result->num_rows();

//get the category for the current questionNumber
$sql="SELECT IdCategory FROM a19ux3.Question";
$result = $this->db->query($sql);
$IdCategories=array();
if ($result->num_rows() > 0) {
    foreach ($result->result() as $row) {
        array_push($IdCategories, $row->IdCategory);
    }
    sort($IdCategories);
}
$sql="SELECT Category FROM a19ux3.CategoryContent WHERE IdCategory='$IdCategories[$questionNumber]' AND Language='$language'";
$result = $this->db->query($sql);
if($result->num_rows()>0){
    $category= ($result->result())[0]->Category;
} else {
    $category="no category";
}
?>
<script>
    var questionNumber=<?echo $questionNumber;?>;
    var continuePossible=<?echo $continuePossible;?>;
</script>
<script src="<? echo base_url(); ?>assets/js/Jquery-2.2.2.js" type="text/javascript"></script>
<script src="<? echo base_url(); ?>assets/js/Jquery.md5.js" type="text/javascript"></script>
<script src="<? echo base_url(); ?>assets/js/category.js" type="text/javascript"></script>

<body>
<div id="content">
    <div id="main">
        <div class="talk-bubble tri-right btm-right-in">
            <div class="talktext">
            <p><?=$focus_on?><strong><?echo $category?></strong>.</p>
            </div>
        </div>
        <img id="DaisyInCategory" onclick="changeDaisy()" src="<? echo base_url(); ?>assets/images/Daisy/Face<?php echo intval(10*$questionNumber/$total_data)+1;?>_Default.gif" alt="">
        <div id="buttonGoFurther">
            <button class="button2Clicked" onclick="location.href='<? echo base_url(); ?>ResidentController/resident/Questions'">Ok</button>
        </div>
    </div>
</div>
</body>
<script>
    function changeDaisy(){
        console.log("k");
        document.getElementById("DaisyInCategory" ).src="<? echo base_url(); ?>assets/images/Daisy/Face<?php echo intval(10*$questionNumber/$total_data)+1;?>Boop.gif";
        setTimeout(changeBack, 3000)
    }
    function changeBack(){
        document.getElementById("DaisyInCategory" ).src="<? echo base_url(); ?>assets/images/Daisy/Face<?php echo intval(10*$questionNumber/$total_data)+1;?>_Default.gif";
    }
</script>
</html>
