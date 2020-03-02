<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo base_url(); ?>assets/css/main_table.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/feedback.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

    <title>Woonzorgcentrum</title>
    <body>
<div class="header">
        <img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
        <h1>Kies jouw woonzorgcentrum</h1>
        <br>
        <script> var base_url = "<?php echo base_url();?>";</script>
</div>
    </body>
</head>
<body>
<div class="container" stype="margin-top:35px">
    <!--Table-->
    <table class="table table-striped results " id="Table" cellspacing="0" width="100%">
        <!--Table head-->
        <thead>
            <tr>
                <th class="th-sm">#</th>
                <th class="th-sm">Woonzorgcentrum</th>
                <th class="th-sm">Kies</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody id="myTable">
        <?php
        $i=1;
        foreach($fetch_data->result() as $row){
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$row->NursingHome</td>";
            if(isset($n_home)){
                if($n_home == $row->NursingHome)
                echo "<td><button type='button' class='takeCare' name='NursingHome'id='$row->NursingHome' value='$row->NursingHome' style='background-color: rgb(205,219,166)'> Kies </button></td>";
                else echo "<td><button type='button' class='takeCare' name='NursingHome'id='$row->NursingHome' value='$row->NursingHome'> Kies </button></td>";

            }
            else
                echo "<td><button type='button' class='takeCare' name='NursingHome'id='$row->NursingHome' value='$row->NursingHome'> Kies </button></td>";
            echo "</tr>";
            $i++;

        }
        ?>
        </tbody>
        </tbody>
        <!--Table Body End-->
    </table>
    <!-- End container-->
    <script src="<?php echo base_url(); ?>assets/js/NursingHome.js" type="text/javascript"></script>
</div>
<!--Table-->
<br><br>

</html>

