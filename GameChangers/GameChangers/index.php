<?php
session_start();

$pageName = "Home";
$_SESSION["loggedin"] = true;

if (!isset($_SESSION["games"])) $_SESSION["games"] = [
    0 => [
        0 => "Game Name",
        1 => "01/01/2001",
        2 => "RPG",
        3 => "6/10"
    ],
    1 => [
        0 => "Game Name",
        1 => "01/01/2001",
        2 => "RPG",
        3 => "6/10"
    ],
    2 => [
        0 => "Game Name",
        1 => "01/01/2001",
        2 => "RPG",
        3 => "6/10"
    ]
];

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<p>
    Welcome to Game Changers! Game Changers is a website for you to compile game information, whether they be games you own or games you've only heard of!
</p>

<?php

if (isset($_SESSION['loggedin']))
{
    echo "
    <table>
        <tr>
            <th>
                Name
            </th>
            <th>
                Release Date
            </th>
            <th>
                Genre
            </th>
            <th>
                Rating
            </th>
        </tr>";
    foreach ($_SESSION["games"] as [$name, $releaseDate, $genre, $rating])
    {
        echo "
        <tr>
            <td>
                $name
            </td>
            <td>
                $releaseDate
            </td>
            <td>
                $genre
            </td>
            <td>
                $rating
            </td>
        </tr>";
    }
    echo "</table>";
}

?>

<?php
include_once "./Wrappers/footer.php";
?>
