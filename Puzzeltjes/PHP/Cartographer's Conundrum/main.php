<?php

// Get the file contents
$file = file_get_contents("map_data.json");
// Turn JSON into array
$map = json_decode($file, true);
// New 1D map
$new_map = [];

foreach ($map as $key => $value) {
    foreach ($value as $k => $v) {
        if ($v['type'] != 'street') {
            $v['coordinates'] = "$key,$k";
            array_push($new_map, $v);
        }
    }
}

// Sort array
sort($new_map);
var_dump($new_map);
