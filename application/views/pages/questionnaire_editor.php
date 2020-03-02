<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
<div class="container" stype="margin-top:35px">
    <?php if($this->session->tempdata('add_question_success')):?>
        <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('add_question_success').'</p>'?>
    <?php endif; ?>
    <?php if($this->session->tempdata('update_question_success')):?>
        <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('update_question_success').'</p>'?>
    <?php endif; ?>
    <!--Table-->
    <table class="table table-striped results " id="Table" cellspacing="0" width="100%">
        <!--Table head-->
        <thead>
        <tr>
            <th class="th-sm"></th>
            <th class="th-sm">Vraag</th>
            <th class="th-sm" id="noSort">Categorie</th>
            <th class="th-sm"></th>
        </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody id="myTable">
        <?php
        $i=1;
        $base = base_url();
        if (isset($fetch_data)) {
            foreach($fetch_data->result() as $row){
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$row->Content</td>";
                echo "<td>$row->Category</td>";
                if(!$row->IsOptional)
                    echo "<td>Default</td>";
                else
                    echo("<td><button class='takeCare' type =\"button\" onclick=\"location.href='$base/PageController/edit_question/$row->IdQuestion'\">Edit</button></td>");
                echo "</tr>";
                $i++;

            }
        }
        ?>
        </tbody>
        <!--Table Body End-->
    </table>
    <!-- End container-->
    <div class="error_handler">
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
    </div>
    <!-- Adding question -->
    <?php echo form_open('PageController/add_question'); ?>
            <button type='button' class='settings' onclick="location.href='<?php echo base_url(); ?>PageController/add_question'" >
                <strong>Voeg een nieuwe vraag toe</strong></button>
    <?php echo form_close(); ?>
    <!-- Right now the question will always be category: Nursing home and IsOptional is 1   -->
    <!-- Need to make a new page for adding question-->
    <script src="<?php echo base_url(); ?>assets/js/Questionnaire.js" type="text/javascript"></script>
</div>
<!--Table-->

