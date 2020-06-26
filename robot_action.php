<?php

include('Robot.php');

$obj = new Robot();
$obj->place(0, 0, 'SOUTH');
$obj->right();
$obj->move();
$result1 = $obj->report();
if(array_key_exists("error", $result1)){
    $count = count($result1['error']);
    for($i=0;$i<$count;$i++){
        echo $result1['error'][$i];
    }
} else {
    echo "Walle position : x-axis =" . $result1['x-axis'] . " y-axis=" . $result1['y-axis'] . " Face=" . $result1['face'] . "\n";
}
exit;

$obj1 = new Robot();
$obj1->place(0, 0, 'NORTH');
$obj1->left();
$result2 = $obj1->report();
if(array_key_exists('error', $result1)){
    echo $result1['error'];
} else {
    echo "Walle position : x-axis =" . $result2['x-axis'] . " y-axis=" . $result2['y-axis'] . " Face=" . $result2['face'] . "\n";
}

$obj2 = new Robot();
$obj2->place(1, 2, 'EAST');
$obj2->move();
$obj2->move();
$obj2->left();
$obj2->move();
$result3 = $obj2->report();
if(array_key_exists('error', $result1)){
    echo $result1['error'];
} else {
    echo "Walle position : x-axis =" . $result3['x-axis'] . " y-axis=" . $result3['y-axis'] . " Face=" . $result3['face'] . "\n";
}

?>
