<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
<div class="container" stype="margin-top:35px">
    <?php if($this->session->tempdata('select_floor')):?>
        <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('select_floor').'</p>'?>
    <?php endif; ?>
    <!--Table-->
    <table class="table table-striped results " id="Table" cellspacing="0" width="100%">
        <!--Table head-->
        <thead>
        <tr>
            <th class="th-sm">Verdieping</th>
            <th class="th-sm">Ontvang meldingen</th>
        </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody id="myTable">
        <!--<form method='post' action='<?php echo base_url();?>PageController/select_floor'> -->
            <?php
            if (isset($fetch_data)) {
                foreach($fetch_data->result() as $row){
                echo "<tr>";
                echo "<td>$row->Level</td>";
                if($row->Value ==1)
                    echo "<td> <input type='checkbox' name='level' id='myCheckbox' class='get_value' value='{$row->Level}' checked/></td>";
                else
                    echo "<td> <input type='checkbox' name='level'id='myCheckbox' class='get_value' value='{$row->Level}' /></td>";
                echo "</tr>";
            }
            }
                //print_r($fetch_data);
            ?>
            </tbody>
            <!--Table Body End-->
        </table>
    <button type ='submit' id="Save" class="settings"><strong>Bewaar</strong></button>
    <!--</form> -->
    <!-- End container-->
</div>
<h4 id="result"></h4>
<script src="<?php echo base_url(); ?>assets/js/table.js" type="text/javascript"></script>
</body>
<!--Table-->

