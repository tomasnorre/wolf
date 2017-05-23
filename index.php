<html>
<head>
    <link rel="stylesheet" type="text/css" href="wolf.css">
</head>


<body>
<div id="main">

<?php
session_start();

if (isset($_GET['restart'])) {
    session_destroy();
    echo "<form method='post' action='wolf.php'>
        Player 1 <input type='text' name='one' /><br />
        Player 2 <input type='text' name='two' /><br />
        Player 3 <input type='text' name='three' /><br />
        Player 4 <input type='text' name='four' /><br /><br />
        <input type='submit'>
    </form>";
}

if (!isset($_GET['restart'])) {

    if (empty($_SESSION['players'])){
        foreach($_POST as $post) {
            $_SESSION['players'][] = $post;
        }
    }

    if (!empty($_SESSION['players'])){
        echo "Play order: <br /><br />";
        shuffle($_SESSION['players']);
        foreach($_SESSION['players'] as $player) {
            echo $player . "<br />";
        }
    }

}

echo "<br /><a href='wolf.php'>Shuffle</a><br /><br />";
echo "<a href='wolf.php?restart=1'>Restart</a>" . chr(13);
?>

    </div>
</body></html>

