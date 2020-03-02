<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
<div class="container" stype="margin-top:35px">
    <?php if($this->session->tempdata('add_notification')):?>
        <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('add_notification').'</p>'?>
    <?php endif; ?>
    <!--Table-->
    <table class="table table-striped results " id="Table" cellspacing="0" width="100%">
        <!--Table head-->
        <thead>
        <tr>
            <th class="th-sm"></th>
            <th class="th-sm">Notificatie</th>
            <th class="th-sm">Categorie</th>
            <th class="th-sm">Check</th>
        </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody id="myTable">
        <?php
        $i=1;
        if(!empty($fetch_data)) {
            foreach ($fetch_data->result() as $row) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$row->Content</td>";
                echo "<td>Categorie</td>";
                if ($row->IsChecked)
                    echo "<td>In orde gebracht door $row->Lastname </td>";
                else
                    echo "<td><button type='button' class='takeCare' id='$row->IdNotification'>Ik zorg hiervoor</button></td>";
                echo "</tr>";
                $i++;

            }
        }
        ?>
        </tbody>
        <!--Table Body End-->
    </table>
    <!--Table-->
    <!-- take care function -->
        <button type='button' class='settings' onclick="location.href='<?php echo base_url(); ?>PageController/add_notification'" >
           <strong> Voeg een notificatie toe </strong> </button>
    <script src="<?php echo base_url(); ?>assets/js/Notification.js" type="text/javascript"></script>
</div>
<!-- End container-->


