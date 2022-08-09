<?php
$pageName = "Home";
$user = true;
$games = [
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
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque semper elit nisl, at cursus felis dapibus at. Ut vitae est consectetur, faucibus augue vel, faucibus sem. Praesent accumsan mollis nunc et viverra. Integer consectetur sodales tincidunt. Praesent ullamcorper nisl sed sem malesuada ullamcorper. Sed blandit, justo nec euismod vulputate, dui ligula eleifend quam, in tempus lorem ligula eu lectus. Cras et venenatis nulla, sit amet tincidunt risus. Ut nunc sapien, feugiat et aliquam et, finibus id mauris. Sed a libero varius nunc tincidunt dictum eu eget odio. Etiam gravida dui vitae felis accumsan pellentesque ut nec quam.
</p>

<?php

if ($user != null)
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
    foreach ($games as [$name, $releaseDate, $genre, $rating])
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
