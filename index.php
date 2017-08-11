<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.07.2017
 * Time: 9:59
 */

$array = array(
    "foo" => "bar",
    42    => 24,
    "multi" => array(
        "dimensional" => array(
            "array" => "foo"
        )
    )
);

var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);

echo '<br>';

$massive = array(
    1 => array(
        'id' => 1,
        'name' => 'Alex',
        'parent_id' => ''
    ),
    2 => array(
    'id' => 2,
        'name' => 'Felixovich',
        'parent_id' => '1'
    ),
    3 => array(
    'id' => 3,
        'name' => 'Sergei',
        'parent_id' => ''
    ),
    4 => array(
        'id' => 4,
        'name' => 'Sasha',
        'parent_id' => ''
    ),
    5 => array(
        'id' => 5,
        'name' => 'Grey',
        'parent_id' => ''
    ),
    6 => array(
        'id' => 6,
        'name' => 'Deogenovich',
        'parent_id' => '2'
    ),
    7 => array(
        'id' => 7,
        'name' => 'Parazitevich',
        'parent_id' => '5'
    ),
    8 => array(
        'id' => 8,
        'name' => 'Sosedovich',
        'parent_id' => '4'
    ),
    9 => array(
        'id' => 9,
        'name' => 'Durovich',
        'parent_id' => '3'
    ),
);
//var_dump($array["9"]);

    echo '<br><br>';

    function checkParent($massive, $parent_id){
                        foreach($massive as $value){
                            if($parent_id = $value['id']){
                                $value = $value['name'];                            }
                        }
        return $massive;
    }

    foreach ($massive as $value){
            if(!$value['parent_id']){
                $value['parent_name'] = '';
                $value = $value['name'];
            } else{
                $value['parent_name'] = checkParent($massive, $value['parent_id']);
                $value = $value['name']. ' ' . $value['parent_name'];
            }
    }
    echo $massive; //не работает

echo '<br><br>';

$array = array(1, 2, 3, 4, 5);
print_r($array);
echo '<br><br>';
foreach ($array as $i => $value) {
    unset($array[$i]);
}
print_r($array);
echo '<br><br>';
$array[] = 6;
print_r($array);

echo '<br><br>';
$colors = array('red', 'blue', 'green', 'yellow');

foreach ($colors as $color) {
    echo "Вам нравится $color?<br>";
}
