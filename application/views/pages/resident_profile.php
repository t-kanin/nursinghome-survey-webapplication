<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/resident_profile.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/Note.js" type="text/javascript"></script>
    <script> var base_url = "<?php echo base_url();?>"; </script>

    <title>Profile</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <?php if($this->session->tempdata('save_note')):?>
                <?php echo '<p class = "alert alert-success">'.$this->session->tempdata('save_note').'</p>'?>
            <?php endif; ?>
            <div id="information-box">
                <div>
                    <h2> <?php echo element('Firstname',$Profile)?> <?php echo element('Lastname',$Profile)?></h2>
                </div>
                <div class="attribute">
                    <i class="material-icons">house</i>
                    <span>Room <?php echo element('Room',$Profile)?></span>
                </div>
                <div class="attribute">
                    <i class="material-icons">calendar_today</i>
                    <span><?php echo element('Birthdate',$Profile)?></span>
                </div>
                <div class="attribute">
                    <i class="material-icons">language</i>
                    <span> <?php echo element('Language',$Profile)?></span>
                </div>
                <div>
                    <button  onclick="location.href='<?php echo base_url(); ?>Users/edit_resident/<?php echo $IdResident ?>';">
                        Edit
                    </button>
                </div>
                <br><br>
                <div id="notes">
                    <h4>Note</h4>
                    <textarea  name="note" id="txt" cols="30" rows="10" form="txt" input="text" placeholder="Add useful notes here. Don't forget to save them." maxlength="500" ><?php
                        if(array_key_exists('Note',$Note))
                            echo element('Note',$Note);
                            ?></textarea><br>
                    <button  class = "save" id ="<?php echo $IdResident?>">
                        Save Notes
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div id="chart_div">

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
                            'height':600,
                            chartArea: {width: '70%',
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
            </div>
        </div>
    </div>
</div>
<button onclick="history.back()" class="corner-button">
    <strong>Back</strong>
</button>


</body>
</html>