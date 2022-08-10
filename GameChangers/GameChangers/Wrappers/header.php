
<!DOCTYPE html>
<html lang="en">

<?php 

session_start();
require "config.php"; 

$WebsiteName = "Game Changers" . " - " . $pageName;
if(!isset($_SESSION['style']))
{
    $_SESSION['style'] = "../Styles/style1.css";
}
if(isset($_POST['styleChoice'])){
	switch ($_POST['styleChoice'])
    {
        case "Style 1":
            $_SESSION['style'] = "../Styles/style1.css";
            break;
        case "Style 2":
            $_SESSION['style'] = "../Styles/style2.css";
            break;
        case "Style 3":
            $_SESSION['style'] = "../Styles/style3.css";
            break;
    	default:
            $_SESSION['style'] = "../Styles/style1.css";
            break;
    } 
}

$Header = "Game Changers";

$Style = $_SESSION['style'];

function SetGamesByUser($uId)
{
    /*
    UserTable UserGameTable Game Table
    UserTable.UserId -> UserGameTable.GameId    ->  GameTable.*

    Get All Game Info From GameTable By Filtering UserGameTable On UserId
     */
    $sql4 = "SELECT g.GameName, g.ReleaseDate, g.Genre, g.Rating, g.GameId
                                               FROM UserGameTable as ug
                                               LEFT JOIN UserTable as u
                                               ON ug.UserId = u.UserId
                                               LEFT JOIN GameTable as g
                                               ON g.GameId = ug.GameId
                                               WHERE ug.UserId = $uId";
    if($res = mysqli_query($_SESSION["link"], $sql4))
    {
        $results = array();
        while ($games = mysqli_fetch_assoc($res))
        {
            $results[] = $games;
        }

        $_SESSION["games"] = $results;

        for ($i = 0; $i < count($_SESSION['games']); $i++)
        {
            $_SESSION["games"][$i] = array_combine(range(0, count($_SESSION["games"][$i])-1),
                                               array_values($_SESSION["games"][$i])
                                               );
        }
    }
}

?>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title name="siteTitle"><?php echo $WebsiteName; ?></title>
  <link rel="stylesheet" href="<?php echo $Style; ?>" />
</head>
<body>

<h1><?php echo $Header ?></h1>

<form method="post" action="">
    <input class="btn" type="submit" name="styleChoice" value="Style 1" /> &nbsp; &nbsp;
    <input class="btn" type="submit" name="styleChoice" value="Style 2" /> &nbsp; &nbsp;
    <input class="btn" type="submit" name="styleChoice" value="Style 3" />
</form>

<br />
