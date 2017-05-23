<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fyn Invitational 2017</title>

    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/wolf.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body>
<div class="container">
    <div class="jumbotron">
            <h1>Wir Wolfen</h1>
    </div>
<div id="main">

<?php
session_start();

if (isset($_GET['restart'])) {
    session_destroy();
    echo "<form method='post' action='index.php'>
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

echo "<br /><a href='index.php'>Shuffle</a><br /><br />";
echo "<a href='index.php?restart=1'>Restart</a>";
?>

    </div>
</body></html>

