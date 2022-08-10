<?php
session_start();

$pageName = "Register Account";

require "config.php";
require "./Wrappers/header.php";
require "./Wrappers/menu.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"])))
    {
        $username_err ="Please enter a username.";
    }
    //elseif(!preg_match('/a-zA-Z0-9_]+$/', trim($_POST["username"])))
    //{
    //    $username_err = "Username can only contain letters, numbers, and underscores.";
    //}
    else
    {
        $temp_user = trim($_POST['username']);
        $sql = "SELECT UserId FROM UserTable WHERE UserName = ?";
        if($stmt = mysqli_prepare($_SESSION["link"], $sql))
        {
            mysqli_stmt_bind_param($stmt, 's', $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken.";
                }
                else
                {
                    $username = $temp_user;
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";
    }
    else if(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have at least 6 characters.";
    }
    else
    {
        $password = trim($_POST["password"]);
    }

    //else
    //{
    //    $password = trim($_POST["confirm_password"]);
    //    if(empty($password_err) && ($password != $confirm_password))
    //    {
    //        $confirm_password_err = "Password did not match.";
    //    }
    //}
    if (empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";
    }
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        $sql = "INSERT INTO UserTable (UserName, password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($_SESSION["link"], $sql))
        {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt))
            {
                header("location: login.php");
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($_SESSION["link"]);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Sign Up</title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div class="wrapper">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control 
                        <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"/>
                    <span class="invalid-feedback">
                        <?php echo $username?>
                    </span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control
                           <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" />
                    <span class="invalid-feedback">
                        <?php echo $password_err; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control
                           <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"/>
                    <span class="invalid_feedback">
                        <?php echo $confirm_password_err ?>
                    </span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="submit"/>
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset"/>
                </div>
                <p>
                    Already have an account? 
                    <a href="login.php">Login Here</a>
                </p>
            </form>
        </div>
    </body>
</html>

<?php
require "./Wrappers/footer.php";
?>