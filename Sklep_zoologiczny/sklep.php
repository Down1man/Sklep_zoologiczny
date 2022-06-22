<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <?php
        @$login = $_POST['login'];
        @$haslo = $_POST['haslo'];

        $con = new mysqli('localhost', 'root', '', 'sklep');

        $zapytanie = "SELECT Login FROM users";
        $wynik = mysqli_query($con, $zapytanie);

        $zapytanie2 = "SELECT Haslo FROM `users`";
        $wynik2 = mysqli_query($con, $zapytanie2);


        $loginy = [];
        $hasla = [];

        $i = 0;
        while($r = mysqli_fetch_assoc($wynik)){
            $loginy[$i] = $r['Login'];
            $i++;
        }
        $c = 0;
        while($t = mysqli_fetch_assoc($wynik2)){
            $hasla[$c] = $t['Haslo'];
            $c++;
        }

        $ii = 0;
        $zalogowano = FALSE;
        $suma = count($loginy);
        for($x=0; $x<$suma; $x++){
            if(($loginy[$x] == $login) && ($hasla[$x] == $haslo)){
            $ii++;
            }
        }

        if($ii !=0){
            $zalogowano = TRUE;
        }

        if($zalogowano){
            ?>
                <div id="przywitanie">
                    <h3>Wiatamy na stronie!</h3>
                </div>
            <?php
        }
        else{
            ?>
                <div id="przywitanie">
                <h3>Nie udało się zalogować</h3>
                </div>
            <?php
        }

        ?>
        <div>
            <a href="rejestracja.php" id="rejestracja">ZAREJESTRUJ SIĘ</a>
            <a href="login.php" id="logowanie">ZALOGUJ SIĘ</a>
        </div>
        <div id="baner">
            <img src="baner.png" width="100%" height="50%">
        </div>

        <h4>Poszukaj artykułów dla siebie</h4>
        <form action="sklep.php" method="POST">
            Nazwa: <input type="text" name="nazwa"><br><br>
            <input type="submit" value="WYSZUKAJ">
        </form>

    <?php
    $conn = new mysqli('localhost', 'root', '','sklep');
    @$nazwa = $_POST['nazwa'];
    @$wyszukanie = FALSE;
    $query = "SELECT * FROM `produkt` WHERE nazwa LIKE '%$nazwa%'";

    if(!empty($nazwa)){
        $wyszukanie = TRUE;
    }

    if ($wyszukanie == TRUE){
        $wynik11 = mysqli_query($conn, $query);
        while($wiersz1=mysqli_fetch_array($wynik11)){
            echo "<div id='blok'>".$wiersz1['nazwa']."<br>".$wiersz1['cena']."<br>";
            echo "<img src='".$wiersz1['zdjecie']."' width='100' height='100'>"."<br>".$wiersz1['opis']."</div>";
        }
    }
    else{
        $wys="SELECT * FROM produkt";
        $wynik=mysqli_query($conn,$wys);
    
        while($wiersz=mysqli_fetch_array($wynik)){
            echo "<div id='blok'>".$wiersz['nazwa']."<br>".$wiersz['cena']."<br>";
            echo "<img src='".$wiersz['zdjecie']."' width='100' height='100'>"."<br>".$wiersz['opis']."</div>";
            }
    }

    mysqli_close($conn);
    ?>
    
</body>
</html>