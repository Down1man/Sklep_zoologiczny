<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <form action="rejestracja.php" method="POST">
    Podaj swoj login: &nbsp <input type="text" name="login"><br>
    Podaj swoje haslo: <input type="text" name="haslo"><br>
    <input type="submit" value="ZAREJESTRUJ">
    </form>

    <p>Jeśli się już zarejestrowałaś/-łeś to zapraszamy na stronę główną</p>
    <a href="sklep.php">strona główna</a>

    <?php
        @$login = $_POST['login'];
        @$haslo = $_POST['haslo'];

        $con = mysqli_connect('localhost', 'root', '', 'sklep');

        $dodanie = "CREATE USER '$login'@'localhost' IDENTIFIED BY '$haslo'";
        $dodanie2 = "INSERT INTO sklep.users (ID, Login, Haslo) VALUES ('', '$login', '$haslo')";
        $uprawnienia = "GRANT UPDATE, INSERT, DELETE ON sklep.produkt TO '$login'@'localhost'";

        
        if ($wynik = mysqli_query($con, $dodanie) and $wynik2 = mysqli_query($con, $dodanie2)){
            echo "<p>Pomyślnie zarejestrowany</p>";
        }
        else{
            echo "Błąd";
        }
        $wynik1 = mysqli_query($con, $uprawnienia);
    ?>
</body>
</html>