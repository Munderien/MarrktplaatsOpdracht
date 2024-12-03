<?php
include("Config.php");
session_start();
if ($_POST) {

    $v = $db->prepare("select * from user where username = ? and password = ?");

    $naam = $_POST['naam'];
    $wachtwoord = md5(addslashes($_POST['wachtwoord']));

    $v->execute(array($naam, $wachtwoord));

    $x = $v->fetch(PDO::FETCH_ASSOC);

    $d = $v->rowCount();

    if ($d) {
        $_SESSION['user'] = $x['username'];
        $_SESSION['id'] = $x['id'];
        $_SESSION['rol'] = $x['rol'];
    } else {
        echo "U heeft de verkeerde gegevens ingevoerd";
    }

    if ($_SESSION) {
        echo "welkom " . $_SESSION['user'] . " <a href='Logout.php'>uitloggen </a>
    <a href='Change.php?id=" . $_SESSION['id'] . "'>Profiel Wijzigen </a>";

        if ($_SESSION['rol'] == 1) {
            echo "<a href='admin.php'>Admin Panel </a>";
        }
    }
} else {
?>
    <html>

    <head>
        <style>
            body {
                background: linear-gradient(to bottom right, pink, purple);
            }

            input {
                border-radius: 5px;
                border-color: black;
                margin: 5px;
                padding: 5px;

                background: linear-gradient(to bottom right, green, blue);

                color: black;
                font-size: 16px;
            }
        </style>
    </head>

    <body>
        <form method="post" action="">
            <table>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="naam"> </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="wachtwoord"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="inloggen"></td>
                </tr>
            </table>
        </form>
    </body>

    </html>
<?php
}
?>