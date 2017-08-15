<?php
$a1 = array(
    array(
        "color" => "red",
        "size" => 3
    ),
    array(
        "color" => "green",
        "size" => 2
    ),
);
$a2 = array(
    array(
        "color" => "blue",
        "size" => 1
    ),
    array(
        "color" => "yellow",
        "size" => 2
    ),
);
print_r(array_merge($a1, $a2));
?>