<?php
echo $_POST['email'];
echo $_POST['passwort'];
$file_to_read = fopen('file.csv', 'r');
$row = 1;
$dataArray = array();
$options = [ 'cost' => 10, 'salt' => 'usesomesillystringforsalt' ];
$hashedPasswort = password_hash($_POST['passwort'], PASSWORD_BCRYPT, $options);
 

if($file_to_read !== FALSE){
     
    while(($data = fgetcsv($file_to_read, 300, ';')) !== FALSE){
        $num = count($data);
        $dataArray[$row-1] = $data;
        $row++;    
    }
    fclose($file_to_read);
}

$num2 = count($dataArray);
echo "<p>Array Länge $num2 </p>";

foreach($dataArray as $value){
    if($value[2] == $_POST['email']){
        //echo "<p>Email passt.</p>";
        if($value[3] == $hashedPasswort){
            //echo "<p>Passwort passt.</p>";
            break;
        } else {
            //echo "<p>Passwort passt nicht.</p>";
        }    
    } else {
        //echo "<p>Email passt nicht.</p>";
    }
}

echo "<p>Jetzt de Datenbank: </p>";

$server = 'localhost';
$username = 'tobiasollmaier';
$password = 'W1ll0fth3W1sps';
$database = 'html_db';

try{
    $connection = new PDO('mysql:host=myjesussqlserver.mysql.database.azure.com;dbname=html_db', $username, $password);
    // EXCEPTION konfigurieren

    $stmtuser = $connection->prepare ("SELECT * FROM user WHERE user.email = :email and user.passwort = :passwort");
    $stmtuser->bindParam(':email', $_POST["email"]);
    $stmtuser->bindParam(':passwort', $hashedPasswort);
    $stmtuser->execute();
    $result = $stmtuser->fetchAll(PDO::FETCH_ASSOC);
    session_destroy();

    if($result) {
        //echo ('<p>Passwort passt a bei da Datenbank</p>');
        session_start();
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["passwort"] = $hashedPasswort;
        echo file_get_contents("index.html");
    } else {
        //echo ('<p>Passwort passt ned bei da Datenbank</p>');
    }
    
    }
    catch(PDOException $e)
     {
     echo ( 'Fehler: ' . $e->getMessage());
     }
    $connection = null;
 
?>