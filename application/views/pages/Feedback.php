<body>
<img src="<?php echo base_url(); ?>assets/images/Plant_with_green_background.png" class="background_picture" style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;opacity:0.5'/>
<div class="container" stype="margin-top:35px">
    <!--Table-->
    <table class="table table-striped results " id="Table" cellspacing="0" width="100%">
        <!--Table head-->
        <thead>
        <tr>
            <th class="th-sm"></th>
            <th class="th-sm">Feedback</th>
            <th class="th-sm">Audio</th>
            <th class="th-sm">Bewoner</th>
        </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody id="myTable">

        <?php
        $i=1;
        if (isset($fetch_data)) {
            foreach($fetch_data->result() as $row){
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$row->Content</td>";
                if($row->IsSpoken)
                    echo "<td id='audio$i' onclick='recStart()'><audio controls src='https://a19ux3.studev.groept.be/Master/assets/audio/$row->AudioName'> </audio></td> 
                    <text id='audioAddress$i' style='display:none'>$row->AudioName</text>";
                else
                    echo "<td></td>";
                if(!$row->IsAnonymous)
                    echo "<td> $row->Username </td>";
                else
                    echo "<td>Anoniem</td>";
                echo "</tr>";
                $i++;
            }
        }

        ?>
        <script>
            let tableLength=document.getElementById("Table").rows.length-1;
            sessionStorage.setItem('tableLength',tableLength);

            let AudioElementArray=new Array();
            let AudioAddressArray=new Array();
            for(let i=0;i<100;i++){
                if(document.getElementById("audio"+i)){
                    AudioElementArray.push(document.getElementById("audio"+i));
                    sessionStorage.setItem('audio'+i,document.getElementById("audioAddress"+i).innerHTML);
                    AudioAddressArray.push(sessionStorage.getItem('audio'+i));
                }
            }

            for(let i=0;i<tableLength;i++){
                AudioElementArray[i].addEventListener('click',function () {
                    let audio_url=base_url+"assets/audio/"+AudioAddressArray[i];
                    let audio=new Audio(audio_url);
                    audio.play();
                });
            }

            function recStart(audio_name){
                let audio_url=base_url+"assets/audio/"+audio_name;
                let audio=new Audio(audio_url);
                audio.play();
            }


        </script>
        </tbody>
        <!--Table Body End-->

    </table>
    <!-- End container-->
</div>
<!--Table-->

