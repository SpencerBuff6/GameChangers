<?php

$menu = [
    0 => [
        "name" => "Home Page",
        "link" => "../index.php"
    ],
    2 => [
        "name" => "Game Collection",
        "link" => "../collection.php"
    ]
];

?>

<br />
<a href=<?php echo $menu[0]["link"]; ?>>    <?php echo $menu[0]["name"]; ?></a> &nbsp; &nbsp;
<a href=<?php echo $menu[2]["link"]; ?>>    <?php echo $menu[2]["name"]; ?></a>
<br />