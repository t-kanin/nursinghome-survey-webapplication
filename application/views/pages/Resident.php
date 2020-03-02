<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>

    <div class="container" stype="margin-top:35px">
        <?php if($this->session->tempdata('create_resident_success')):?>
            <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('create_resident_success').'</p>'?>
        <?php endif; ?>
    <!--Table-->
        <table class="table table-striped results " id="Table" cellspacing="0" width="100%">
            <!--Table head-->
            <thead>
            <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Naam</th>
                <th class="th-sm">Kamer</th>
                <th class="th-sm">Profiel</th>
            </tr>
            </thead>
            <!--Table head-->
            <!--Table body-->
            <tbody id="myTable">
            <?php
            $i=1;
            $link_address = base_url();
            if (isset($fetch_data)) {
                foreach($fetch_data->result() as $row){
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$row->Firstname    $row->Lastname</td>";
                    echo "<td>$row->Room</td>";
                    echo "<td> <a href='$link_address/PageController/resident_profile/$row->IdResident'>Zie profiel</a> </td>";
                    echo "</tr>";
                    $i++;

                }
            }
            ?>
            </tbody>
            <!--Table Body End-->
        </table>
        <!-- End container-->
        <button type='button' class='settings' onclick="location.href='<?php echo base_url(); ?>Users/register_resident'" >
            <strong>Voeg een bewoner toe</strong> </button>
    </div>
    <!--Table-->

