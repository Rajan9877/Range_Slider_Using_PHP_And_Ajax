<?php

include 'config.php';

/* Range */
$min = $_POST['min'];
$max = $_POST['max'];

/* Query */
$query = "SELECT * FROM students WHERE age BETWEEN '$min' AND '$max'";
$result = mysqli_query($conn, $query);

$html = '';
while( $row=mysqli_fetch_array($result) ){
    $id = $row['id'];
    $name = $row['student_name'];
    $age = $row['age'];
    $city = $row['city'];

    $html .='<tr>';
    $html .='<td>'.$id.'</td>';
    $html .='<td>'.$name.'</td>';
    $html .='<td>'.$age.'</td>';
    $html .='<td>'.$city.'</td>';
    $html .='</tr>';
}

echo $html;