<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.07.2017
 * Time: 11:01
 */

        $fruits = array ( "фрукты"  => array ( "a" => "апельсин",
            "b" => "банан",
            "c" => "яблоко"
        ),
            "числа"   => array ( 1,
                2,
                3,
                4,
                5,
                6
            ),
            "дырки"   => array (      "первая",
                5 => "вторая",
                "третья"
            )
        );

        //print_r($fruits);
        echo '<br><br>';
        echo $fruits["дырки"][5].'<br><br>';
        echo $fruits["фрукты"]["a"].'<br><br>';
        unset($fruits["дырки"][0]);
        $juices["apple"]["green"] = "good";
        print_r($fruits);
        print_r($juices);

        echo '<br><br>';
            $data = array(
                array('id' => 1, 'parent_id' => null, 'value' => 0),
                array('id' => 2, 'parent_id' => 1, 'value' => 10),
                array('id' => 3, 'parent_id' => 1, 'value' => 30),
                array('id' => 4, 'parent_id' => 2, 'value' => 50),
            );
            function search($data, & $current, $parent = null)
            {
                foreach ($data as $item) {
                    if ($item['parent_id'] == $parent) {
                        $value = isset($item['value']) ? $item['value'] : 0;
                        $current += $value;
                        search($data, $current, $item['id']);
                    }
                }
                return $current;
            }

            $current = 0;
            echo search($data, $current, 1);
