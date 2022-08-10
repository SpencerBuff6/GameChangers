<?php
session_start();

$pageName = "Add Game";

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

    $sql = "INSERT INTO GameTable (GameName, ReleaseDate, Genre, Rating) VALUES (?, ?, ?, ?)";
    if($stmt = mysqli_prepare($_SESSION["link"], $sql))
    {
        mysqli_stmt_bind_param($stmt, "ssss", $param_GameName, $param_ReleaseDate, $param_Genre, $param_Rating);

        $param_GameName = $tempGameName;
        $param_ReleaseDate = $tempReleaseDate;
        $param_Genre = $tempGenre;
        $param_Rating = $tempRating;

        // If Game Added Proper
        if(mysqli_stmt_execute($stmt))
        {
            // Get UserId and GameId
            $tempUserId = $_SESSION["id"];
            $tempGameId = null;

            $sql2 = "SELECT GameId FROM GameTable WHERE GameName = ? AND ReleaseDate = ? AND Genre = ? AND Rating = ? LIMIT 1";
            if($stmt = mysqli_prepare($_SESSION["link"], $sql2))
            {
                mysqli_stmt_bind_param($stmt, 'ssss', $param_GameName, $param_ReleaseDate, $param_Genre, $param_Rating);

                $param_GameName = $tempGameName;
                $param_ReleaseDate = $tempReleaseDate;
                $param_Genre = $tempGenre;
                $param_Rating = $tempRating;

                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        // Store GameId of Newly Added Game
                        mysqli_stmt_bind_result($stmt, $tempGameId);

                        if(mysqli_stmt_fetch($stmt))
                        {
                            $sql3 = "INSERT INTO UserGameTable (UserId, GameId) VALUES (?, ?)";
                            if($stmt = mysqli_prepare($_SESSION["link"], $sql3))
                            {
                                mysqli_stmt_bind_param($stmt, "ii", $param_UserId, $param_GameId);

                                $param_UserId = $tempUserId;
                                $param_GameId = $tempGameId;

                                // If UserGameTable Inserted Into
                                if(mysqli_stmt_execute($stmt))
                                {
                                    SetGamesByUser($tempUserId);
                                }
                            }

                            header("location: index.php");
                        }
                    }
                    else
                    {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            header("location: index.php");
        }
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($_SESSION["link"]);
}
// If Not Adding Game Proper
else
{

}
?>

<h1>
    <?php echo $pageName; ?>
</h1>

<form method="post" action="">
    <fieldset>
        <label for="gameName">Game Name:</label>        <input type="text" name="gameName" size="20" /> <br />
        <label for="releaseDate">Release Date:</label>  <input type="text" name="releaseDate" size="20" /> <br />
        <label for="genre">Genre:</label>               <input type="text" name="genre" size="20" /> <br />
        <label for="rating">Rating:</label>             <input type="text" name="rating" size="20" /> <br />
    </fieldset>
    <input class="btn" type="submit" name="GameSubmit" value="Add Game" />
</form>

<?php
include_once "./Wrappers/footer.php";
?>
