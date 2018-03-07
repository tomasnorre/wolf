<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Wir Wolfen</title>

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
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Wir Wolfen</h1>
        </div>
    </section>
    <div id="main">

<?php
if (isset($_GET['restart'])) {
    session_destroy();
    $_SESSION['randomTee'] = false;

    echo "<form method='post' action='index.php'>
        Player 1 <input type='text' name='one' /><br />
        Player 2 <input type='text' name='two' /><br />
        Player 3 <input type='text' name='three' /><br />
        Player 4 <input type='text' name='four' /><br />
        Random Tee <input type='checkbox' name='randomTee'><br /><br />
        <input type='submit' class='btn btn-primary'>
    </form>";
}


if (!isset($_GET['restart'])) {

    if (empty($_SESSION['players'])){
        foreach($_POST as $key => $post) {
            if ($key === 'randomTee') {
                $_SESSION['randomTee'] = true;
                continue;
            }
            $_SESSION['players'][] = $post;
        }
    }

    if (!empty($_SESSION['players'])){

        if ($_SESSION['randomTee']) {
            $teeArray = ['white', 'yellow', 'blue', 'red'];
            shuffle($teeArray);
            $tee = array_pop($teeArray);
            echo '<div class="tee ' . $tee . '">TeeBox: ' . $tee . '</div>';
        }

        echo "<br />Play order: <br /><br />";
        shuffle($_SESSION['players']);
        foreach($_SESSION['players'] as $player) {
            echo $player . "<br />";
        }
    }

}

echo "<br /><a href='index.php'><button type=\"button\" class=\"btn btn-success\">Shuffle</button></a><br /><br />";
echo "<a href='index.php?restart=1'><button type=\"button\" class=\"btn btn-danger\">Restart</button></a>";
?>

    </div>
</body></html>

