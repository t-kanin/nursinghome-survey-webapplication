<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="<?php echo base_url(); ?>assets/css/main_table.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <title><?php if (!empty($title)) {
                echo $title;
            } ?>
        </title>
        <body>
        <div class="header">
            <div class="homebutton" onclick="location.href='<?php echo base_url(); ?>PageController/view/overview';">
                <strong>Hoofdmenu</strong>
            </div>
        <h1><?php if (!empty($title)) {
                echo $title;
            } ?>
        </h1>
        <script>
            var base_url = "<?php echo base_url();?>";
            var caregiver_id = "<?php echo $this->session->userdata('User_id'); ?>";
        </script>

        </div>
    </body>
    </head>
</html>
<html>