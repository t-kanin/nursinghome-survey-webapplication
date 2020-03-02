<!DOCTYPE html>
<html lang="en" xmlns:id="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Statistics</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/thisweekgraph.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">


        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        var lineWidthSelected = 3;
        var selected = [lineWidthSelected,0,0,0,0,0,0,0,0,0,0];

        function drawChart() {

            $(function() {

                var start = moment().subtract(60, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    localStorage.setItem("startDate", start.valueOf());
                    localStorage.setItem("endDate", end.valueOf());
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Voorbije 2 weken': [moment().subtract(13, 'days'), moment()],
                        'Voorbije 3 weken': [moment().subtract(20, 'days'), moment()],
                        'Deze maand': [moment().startOf('month'), moment().endOf('month')],
                        'Vorige maand': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Voorbije 2 maand': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')]
                    }
                }, cb);
                cb(start, end);
            });
            var date_array = <?php echo json_encode($dateArray);?>;
            var result_array = <?php echo json_encode($result);?>;
            var array_check = <?php echo json_encode($arraychecker);?>;
            var dates =[];
            var cat1 = [];
            var cat2 = [];
            var cat3 = [];
            var cat4 = [];
            var cat5 = [];
            var cat6 = [];
            var cat7 = [];
            var cat8 = [];
            var cat9 = [];
            var cat10 = [];
            var cat11= [];

            //console.log(date_array);
            console.log(array_check);

            var startvalue = localStorage.getItem("startDate");
            var endvalue = localStorage.getItem("endDate");

            var startValueDays = startvalue/(1000 * 60 * 60 * 24);
            var endValueDays = endvalue/(1000 * 60 * 60 * 24);

            var startDate = new Date(1*startvalue);
            //console.log(startDate.toString());

            const diffTime = Math.abs(endvalue.valueOf() - startvalue.valueOf());
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const diffweeks = Math.ceil(diffDays / 7);

            console.log("difference of days: ", diffDays);

            var startDateHolder = startDate;
            for(i=0;i<=diffDays;i++){
                //console.log(startDate.toString());
                dates[i] = startDate.toString().substr(4,11);
                startDate = new Date(startDate.getTime() + 1000*60*60*24);
            }
            startDate = startDateHolder;

            var dateHolder;
            var date_array_string = [];
            for(i=0; i<date_array.length;i++){
                dateHolder = new Date(1000*date_array[i]);
                date_array_string[i] = dateHolder.toString().substr(4,11);
            }
            date_array_string = date_array_string.reverse();
            console.log(date_array_string);

            result_array = result_array.reverse();

            var i;
            var startingIndex = date_array_string.indexOf(startDate.toString().substr(4,11));
            console.log(startDate.toString().substr(4,11));
            console.log(startingIndex);
            var i2=0;
            for(i = startingIndex*11; i < result_array.length; i=i+11){
                cat1[i2] = result_array[i];
                cat2[i2] = result_array[i+1];
                cat3[i2] = result_array[i+2];
                cat4[i2] = result_array[i+3];
                cat5[i2] = result_array[i+4];
                cat6[i2] = result_array[i+5];
                cat7[i2] = result_array[i+6];
                cat8[i2] = result_array[i+7];
                cat9[i2] = result_array[i+8];
                cat10[i2] = result_array[i+9];
                cat11[i2] = result_array[i+10];
                i2++;
            }
            var cat1week = DailyAverageToWeeklyAverage(cat1);
            var cat2week = DailyAverageToWeeklyAverage(cat2);
            var cat3week = DailyAverageToWeeklyAverage(cat3);
            var cat4week = DailyAverageToWeeklyAverage(cat4);
            var cat5week = DailyAverageToWeeklyAverage(cat5);
            var cat6week = DailyAverageToWeeklyAverage(cat6);
            var cat7week = DailyAverageToWeeklyAverage(cat7);
            var cat8week = DailyAverageToWeeklyAverage(cat8);
            var cat9week = DailyAverageToWeeklyAverage(cat9);
            var cat10week = DailyAverageToWeeklyAverage(cat10);
            var cat11week = DailyAverageToWeeklyAverage(cat11);

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Dag');
            data.addColumn('number', '+ Privacy');
            data.addColumn('number', '+ Maaltijden');
            data.addColumn('number', '+ Veiligheid');
            data.addColumn('number', '+ Zich Prettig Voelen');
            data.addColumn('number', '+ Autonomie');
            data.addColumn('number', '+ Respect');
            data.addColumn('number', '+ Medewerkers');
            data.addColumn('number', '+ Relatie Met Medewerkers');
            data.addColumn('number', '+ Activiteiten');
            data.addColumn('number', '+ Vriendschap');
            data.addColumn('number', '+ Informatie Verkrijgen');

            for(i=0;i<diffweeks;i++){
                data.addRow([dates[i*7], parseFloat(cat1week[i]),  parseFloat(cat2week[i]) , parseFloat(cat3week[i]), parseFloat(cat4week[i]), parseFloat(cat5week[i]), parseFloat(cat6week[i]), parseFloat(cat7week[i]), parseFloat(cat8week[i]), parseFloat(cat9week[i]), parseFloat(cat10week[i]), parseFloat(cat11week[i])]);
            }

            var options = {
                chart: {
                    title: 'Wekelijkse vooruitgang',
                },
                chartArea: {width: '50%',
                    'backgroundColor': {
                        'fill': '#F5F8ED',
                    }},
                backgroundColor: {
                    'fill': '#FFFFFF',
                    'fillOpacity': 0},
                legend:{
                    position: 'right',
                    'backgroundColor': {
                        'fill': '#F5F8ED',
                    },
                    textStyle:{fontSize: 15, fontName: 'Arial'}
                },
                hAxis: {
                    title: 'Week',
                    //ticks: [0, 1,2,3,4, 5]
                },
                vAxis: {
                    title: 'Wekelijks Gemiddelde',
                    viewWindow:{
                        min: 0,
                        max: 5
                    }
                },
                series: {
                    0: { color: '#e2431a', lineWidth: selected[0]},
                    1: { color: '#43459d', lineWidth: selected[1]},
                    2: { lineWidth: selected[2]},
                    3: { color: '#6f9654' , lineWidth: selected[3] },
                    4: { lineWidth: selected[4]},
                    5: { lineWidth: selected[5]},
                    6: { lineWidth: selected[6]},
                    7: { lineWidth: selected[7]},
                    8: { lineWidth: selected[8]},
                    9: { lineWidth: selected[9]},
                    10: { lineWidth: selected[10]},
                    11: { lineWidth:0}
                },
                selectionMode: 'multiple',
                tooltip: {trigger: 'none'},
                theme: 'material'
            };


            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            google.visualization.events.addListener(chart, 'select', function() { highlightLine(chart,data, options); });

            chart.draw(data, options);}


        function highlightLine(chart,data,options) {
            var itemSelected = chart.getSelection()[0];
            if(options.series[itemSelected.column-1].lineWidth == lineWidthSelected){
                selected[itemSelected.column-1] = 0;
                options.series[itemSelected.column-1].lineWidth=0;
            } else{
                options.series[itemSelected.column-1].lineWidth = lineWidthSelected;
                selected[itemSelected.column-1] = lineWidthSelected;
                options.series[itemSelected.column-1].selectionMode = true;
            }
            chart.draw(data, options);
        }

        function DailyAverageToWeeklyAverage(array){
            var weekly = [];
            //console.log("length is ", array.length);
            i2=0;
            for(i=0;i<array.length;i=i+7){
                var divisionCounter = 0;
                weekly[i2] = 0;
                if(array[i]>0){
                    weekly[i2] = weekly[i2] + array[i];
                    divisionCounter++;
                }
                if(array[i+1]>0){
                    weekly[i2] = weekly[i2] + array[i+1];
                    divisionCounter++;
                }
                if(array[i+2]>0){
                    weekly[i2] = weekly[i2] + array[i+2];
                    divisionCounter++;
                }
                if(array[i+3]>0){
                    weekly[i2] = weekly[i2] + array[i+3];
                    divisionCounter++;
                }
                if(array[i+4]>0){
                    weekly[i2] = weekly[i2] + array[i+4];
                    divisionCounter++;
                }
                if(array[i+5]>0){
                    weekly[i2] = weekly[i2] + array[i+5];
                    divisionCounter++;
                }
                if(array[i+6]>0){
                    weekly[i2] = weekly[i2] + array[i+6];
                    divisionCounter++;
                }
                if(divisionCounter>0){
                    weekly[i2] = weekly[i2]/divisionCounter;}
                else{
                    weekly[i2] = weekly[i2]/1;
                }
                i2++;
            }
            return weekly;
        }
    </script>
</head>
<body>
<div class="stats">
    <button class="longterm" onclick="location.href='<?php echo base_url(); ?>PageController/statistic';">
        <i class="material-icons" style="font-size:20px; vertical-align: middle;">equalizer</i>
        <strong>Ga naar Deze Week</strong>
    </button>

    <div id="reportrange" class="calendar">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span>
        <i class="fa fa-caret-down"></i>
    </div>
    <button class="update" onclick="drawChart()">Update de grafiek</button>
    <!--<button id="dateUpdate" onclick="drawChart();">
        <i class="material-icons" style="font-size:20px; vertical-align: middle;">directions_run</i>
        <strong>Update</strong>
    </button>-->

    <div id="curve_chart" class="chart_longterm"></div>
</div>
</body>
</html>