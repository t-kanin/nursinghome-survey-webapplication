<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistics </title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/thisweekgraph.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        var Privacy =<?php echo $resultArray[0]; ?>;
        var Maaltijden =<?php echo $resultArray[1]; ?>;
        var Veiligheid =<?php echo $resultArray[2]; ?>;
        var ZichPrettigVoelen =<?php echo $resultArray[3]; ?>;
        var Autonomie =<?php echo $resultArray[4]; ?>;
        var Respect =<?php echo $resultArray[5]; ?>;
        var Medewerkers =<?php echo $resultArray[6]; ?>;
        var RelatieMetMedewerkers =<?php echo $resultArray[7]; ?>;
        var Activiteiten =<?php echo $resultArray[8]; ?>;
        var Vriendschap =<?php echo $resultArray[9]; ?>;
        var InformatieVerkrijgen =<?php echo $resultArray[10]; ?>;
        var currentDate = "<?php echo strval($showingDate)?>";
        var barColor1 = "<?php echo strval($barColorArray[0])?>";
        var barColor2 = "<?php echo strval($barColorArray[1])?>";
        var barColor3 = "<?php echo strval($barColorArray[2])?>";
        var barColor4 = "<?php echo strval($barColorArray[3])?>";
        var barColor5 = "<?php echo strval($barColorArray[4])?>";
        var barColor6 = "<?php echo strval($barColorArray[5])?>";
        var barColor7 = "<?php echo strval($barColorArray[6])?>";
        var barColor8 = "<?php echo strval($barColorArray[7])?>";
        var barColor9 = "<?php echo strval($barColorArray[8])?>";
        var barColor10 = "<?php echo strval($barColorArray[9])?>";
        var barColor11 = "<?php echo strval($barColorArray[10])?>";

        function drawMultSeries() {
            var data = google.visualization.arrayToDataTable([
                ['Categorie', currentDate, { role: 'style' }],
                ['Privacy', Privacy, barColor1],
                ['Maaltijden', Maaltijden, barColor2],
                ['Veiligheid', Veiligheid, barColor3],
                ['Zich Prettig Voelen', ZichPrettigVoelen, barColor4],
                ['Autonomie', Autonomie, barColor5],
                ['Respect', Respect, barColor6],
                ['Medewerkers', Medewerkers, barColor7],
                ['Relatie Met Medewerkers', RelatieMetMedewerkers, barColor8],
                ['Activiteiten', Activiteiten, barColor9],
                ['Vriendschap', Vriendschap, barColor10],
                ['Informatie Verkrijgen', InformatieVerkrijgen, barColor11]
            ]);

            var options = {
                title: 'Categories of Nursing Home from ' + currentDate,
                legend: 'none',
                chartArea: {width: '50%',
                    'backgroundColor': {
                        'fill': '#F5F8ED',
                        'fillOpacity': 1
                    }},
                hAxis: {
                    title: 'Score',
                    minValue: 0,
                    ticks: [0, 1,2,3,4, 5]
                },
                vAxis: {
                },
                backgroundColor: {
                    'fill': '#FFFFFF',
                    'fillOpacity': 0},
                animation: {
                    startup: true,
                    duration: 1500,
                    easing: 'inAndOut'
                }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }


    </script>
</head>
<body>
<div class="stats">
    <button class="longterm" onclick="location.href='longtermgraph';">
        <i class="material-icons" style="font-size:20px; vertical-align: middle;">equalizer</i><strong>
            Ga naar Lange Termijn Statistieken</strong>
    </button>

    <table class="progress_table">
        <tr>
            <td></td>
            <td style="font-size:10px;">Verandering sinds vorige week</td>
        </tr>
        <tr>
            <?php if($resultChangeArray[0]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[0]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i id="up" class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[0], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[1]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[1]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[1], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[2]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[2]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[2], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[3]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[3]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[3], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[4]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[4]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[4], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[5]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[5]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[5], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[6]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[6]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[6], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[7]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[7]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[7], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[8]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[8]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[8], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[9]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[9]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[9], 1) ?></td>
        </tr>
        <tr>
            <?php if($resultChangeArray[10]>0){
                $icon = "arrow_drop_up";
                $color = "#91a94b";
            }
            elseif($resultChangeArray[10]<0){
                $icon = "arrow_drop_down";
                $color = "red";}
            else{
                $icon = "remove";
                $color = "gray";}
            ?>
            <td><i class="material-icons" style="font-size:20px; vertical-align: middle; color: <?php echo $color?>;"><?php echo $icon?></i></td>
            <td><?php echo round($resultChangeArray[10], 1) ?></td>
        </tr>
    </table>
    <div id="chart_div" class="chart"></div>
</div>
</body>
</html>