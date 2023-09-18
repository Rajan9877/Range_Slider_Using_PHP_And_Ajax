<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,700;1,6..12,500&family=Open+Sans:ital,wght@0,300;1,600&display=swap" rel="stylesheet">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <title>Range Slider To Fetch Data From Database</title>
    <style>
        .container{
            padding: 10px;
        }
        *{
            font-family: 'Nunito Sans', sans-serif;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }
        .ui-state-default, 
        .ui-widget-content .ui-state-default, 
        .ui-widget-header .ui-state-default, 
        .ui-button, html .ui-button.ui-state-disabled:hover, 
        html .ui-button.ui-state-disabled:active{
            border: 1px solid rgb(0, 0, 0);
            background: rgb(24, 24, 24);
            border-radius: 50%;
        }

        .ui-widget-header {
            border: 1px solid rgb(214, 0, 0);
            background: red;
        }

        .ui-slider{
            border-radius: 50px;
            border: 1px solid black;
        }
        .agebetween{
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        tr, td, th{
            padding: 15px;
            text-align: center;
        }
        th{
            background-color: red;
            font-size: 17px;
            /* color: red; */
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Range Slider</h1>
<?php include "config.php"; ?>
<div class="container" >
    <!-- slider --> 
    <div id="slider"></div><br/>
    <div class="agebetween">
        Age Between : <span id='range'>15 - 27</span>
    </div>
 
    <table id='emp_table' width='100%' border='1' style='border-collapse: collapse;'>
    <!-- <table> -->
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include("config.php");
                $query = "SELECT * FROM students WHERE age BETWEEN 15 AND 27";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                </tr>
            <?php
                    }
                } 
            ?>
        </tbody>
    </table>
</div>
<footer style="background-color: rgb(240, 240, 240); padding: 10px; margin-top: 50px;">
    <div style="text-align: center;">
        <p>Copyright <?php echo date("Y");  ?> | Created By <b>Rajan Joriya</b></p>
    </div>
</footer>
<script>
    $(document).ready(function(){

// Initializing slider
$( "#slider" ).slider({
     range: true,
     min: 13,
     max: 30,
     values: [ 15, 27 ],
     slide: function( event, ui ) {

           // Get values
           var min = ui.values[0];
           var max = ui.values[1];
           $('#range').text(min+' - ' + max);
   
           // AJAX request
           $.ajax({
                url: 'ajaxfile.php',
                type: 'post',
                data: {min:min,max:max},
                success: function(response){

                    // Updating table data
                    $('#emp_table tbody').empty();
                    $('#emp_table tbody').html(response); 
                } 
           });
     }
});
});
</script>
</body>
</html>