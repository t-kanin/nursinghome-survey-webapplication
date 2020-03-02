<!DOCTYPE html>
<html>
<head>
    <title>Table with database</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color: #588c7e;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
</head>
<body>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Password</th>
    </tr>

    <?php
    $this->db->select('Content');
    $this->db->from('Answer');
    $query = $this->db->get();
    if($query->num_rows() > 0){
        foreach($query -> result() as $row){
            ?>
            <tr>
                <td><?php echo $row->Content?> </td>
            </tr>
            <?php
        }
    }
    else{
        ?>
        <tr>
            <td colspan="3">No data Found</td>
        </tr>
        <?php
    }
    ?>
</table>

<button id="test" style="align-self: right" onclick="location.href='statistics';">
    <i class="material-icons" style="font-size:20px; vertical-align: middle;">directions_run</i>
    <strong>Testing</strong>
</button>

</body>
</html>