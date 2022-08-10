<?php 
require "config.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<?php 

session_start();

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
