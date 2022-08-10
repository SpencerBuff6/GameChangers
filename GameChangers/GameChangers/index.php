<?php
session_start();

$pageName = "Home";

if (!isset($_SESSION["games"])) $_SESSION["games"] = [

];

function DeleteGame(int $index)
{
    unset($_SESSION["games"][$index]);

    // Arrays In PHP Do Not Re-index, Must Be Done Manually
    if (count($_SESSION["games"]) != 0)
    {
        $NewIndex = 0;

        $_SESSION["games"] = array_combine(range($NewIndex,
                                                 count($_SESSION["games"]) + ($NewIndex-1)),
                                           array_values($_SESSION["games"]));
    }
}

if (isset($_POST['DeleteGame']))
{
    DeleteGame($_POST['DeleteGame']);
}

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

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
        </tr>";
    }
    echo "</table>";
}

?>

<?php
include_once "./Wrappers/footer.php";
?>
