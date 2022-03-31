<?php
    
    require_once 'class/soma.class.php';
    require_once 'class/dividir.class.php';
    require_once 'class/subtrai.class.php';
    require_once 'class/multiplica.class.php';
    require_once 'class/limpa.class.php';


    $numero = "";
    $result = "";
    $cookie_name1 = "numero";
    $cookie_value1 = "";
    $cookie_name2 = "op";
    $cookie_value2 = "";

    if(isset($_POST['display'])) {
        $numero = $_POST['display'];
    } else {
        $numero = "";
    }

    if(isset($_POST['submit'])) {
        $numero = $_POST['display'] . $_POST['submit'];
    } else {
        $numero = "";
    }

    if (isset($_POST['op'])) {
        $cookie_value1 = $_POST['display'];
        setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/");

        $cookie_value2 = $_POST['op'];
        setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");

        $numero = "";

    }

    if (isset($_POST['equals'])) {
        $numero = $_POST['display'];

        if ($_COOKIE['op'] == "*"){
            $multiplica = new multiplica();
            $result = $multiplica->exe($numero, $_COOKIE['numero']);
        }

        if ($_COOKIE['op'] == "/"){
            $dividir = new dividir();
            $result = $dividir->exe($numero, $_COOKIE['numero']);
        }

        if ($_COOKIE['op'] == "+"){
            $soma = new soma();
            $result = $soma->exe($numero, $_COOKIE['numero']);
        }

        if ($_COOKIE['op'] == "-"){
            $subtrai = new subtrai();
            $result = $subtrai->exe($numero, $_COOKIE['numero']);
        }

        if ($_COOKIE['op'] == "C"){
            $limpa = new limpa();
            $result = $limpa->exe($numero, $result);
        }

        if ($_COOKIE['op'] = "="){
            $numero = $result;
        }  
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form action="" method="post">
        <table border="1">
            <tr>
                <td colspan="4">
                    <input type="text" name="display" value=<?php echo $numero; ?> >
                </td>
            </tr>
            
            <tr>
                <td><input type="submit" name="submit" value="7"></td>
                <td><input type="submit" name="submit" value="8"></td>
                <td><input type="submit" name="submit" value="9"></td>
                <td><input type="submit" name="op" value="/"></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="4"></td>
                <td><input type="submit" name="submit" value="5"></td>
                <td><input type="submit" name="submit" value="6"></td>
                <td><input type="submit" name="op" value="+"></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="1"></td>
                <td><input type="submit" name="submit" value="2"></td>
                <td><input type="submit" name="submit" value="3"></td>
                <td><input type="submit" name="op" value="-"></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="0"></td>
                <td><input type="submit" name="op" value="C"></td>
                <td><input type="submit" name="equals" value="="></td>
                <td><input type="submit" name="op" value="*"></td>
            </tr>
        </table>
    </form>
</body>
</html>