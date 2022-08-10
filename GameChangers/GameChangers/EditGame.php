<?php
session_start();

$pageName = "Edit Game";

include_once "./Wrappers/header.php";
include_once "./Wrappers/menu.php";

// If Adding Game Proper
if(isset($_POST['gameName']) &&
   isset($_POST['releaseDate']) &&
   isset($_POST['genre']) &&
   isset($_POST['rating']))
{
    $tempGameName = trim($_POST['gameName']);
    $tempReleaseDate = trim($_POST['releaseDate']);
    $tempGenre = trim($_POST['genre']);
    $tempRating = trim($_POST['rating']);

    $tempGameId = $_SESSION['EditIds'][1];

    $sql = "UPDATE GameTable SET GameName = '$tempGameName', ReleaseDate = '$tempReleaseDate', Genre = '$tempGenre', Rating = '$tempRating' WHERE GameId = $tempGameId";

    mysqli_query($_SESSION["link"], $sql);
    SetGamesByUser($_SESSION["id"]);
    mysqli_close($_SESSION["link"]);

    header("location: index.php");
}
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="gameName">Game Name:</label><input type="text" name="gameName" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][0] ?>" size="20" /><br />
        <label for="releaseDate">Release Date:</label><input type="text" name="releaseDate" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][1] ?>" size="20" /><br />
        <label for="genre">Genre:</label><input type="text" name="genre" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][2] ?>" size="20" /><br />
        <label for="rating">Rating:</label><input type="text" name="rating" value="<?php echo $_SESSION['games'][$_SESSION['EditIds'][0]][3] ?>" size="20" /><br />
    </fieldset>
    <input class="btn" type="submit" name="GameSubmit" value="Edit Game" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
