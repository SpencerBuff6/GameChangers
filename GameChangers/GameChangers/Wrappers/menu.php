<?php

// Logged Out Menu
$menuOut = [
    0 => [
        0 => "Home Page",
        1 => "../index.php"
    ],
    1 => [
        0 => "Log In",
        1 => "../Login.php"
    ],
    2 => [
        0 => "Register Account",
        1 => "../Register.php"
    ]
];

// Logged In Menu
$menuIn = [
    0 => [
        0 => "Home Page",
        1 => "../index.php"
    ],
    1 => [
        0 => "Add Game",
        1 => "../AddGame.php"
    ],
    2 => [
        0 => "Log Out",
        1 => "../Logout.php"
    ]
];

$menu = $menuIn;

?>

<br />
<?php
    foreach ($menu as [$name, $link])
    {
        echo "<a href=$link> $name</a> &nbsp; &nbsp;";
    }
?>
<br />