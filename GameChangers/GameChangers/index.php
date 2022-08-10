<?php
session_start();

$pageName = "Home";

if (!isset($_SESSION["games"])) $_SESSION["games"] = [

];

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

function DeleteGame(int $index)
{
    // Get GameId For Use With UserGameTable and GameTable
    $gId = $_SESSION["games"][$index][4];

    // Delete From GameTable
    $sql = "DELETE FROM UserGameTable WHERE GameId = $gId";
    mysqli_query($_SESSION["link"], $sql);

    // Delete From UserGameTable
    $sql2 = "DELETE FROM GameTable WHERE GameId = $gId";
    mysqli_query($_SESSION["link"], $sql2);

    SetGamesByUser($_SESSION["id"]);
}

if (isset($_POST['DeleteGame']))
{
    DeleteGame($_POST['DeleteGame']);
}

//print_r($_SESSION["games"]);
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<p>
    Welcome to Game Changers! Game Changers is a website for you to compile game information, whether they be games you own or games you've only heard of!
</p>

<?php

if (isset($_SESSION['loggedin']) && isset($_SESSION["games"]) && count($_SESSION["games"]) > 0)
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
            <th>
                Delete?
            </th>
            <th>
                Edit?
            </th>
        </tr>";
    for($i = 0; $i < count($_SESSION["games"]); $i++)
    {
        $g = $_SESSION["games"][$i];
        echo "
        <tr>
            <td>
                $g[0]
            </td>
            <td>
                $g[1]
            </td>
            <td>
                $g[2]
            </td>
            <td>
                $g[3]
            </td>
            <td>
                <form method='post'>
                    <input class='btn delete' type='submit' name='DeleteGame' value='$i'/>
                </form>
            </td>
            <td>
                <form method='post'>
                    <a href='EditGame.php'>Edit</a>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
}

?>

<?php
include_once "./Wrappers/footer.php";
?>
