<?php
$options = [ 'cost' => 10, 'salt' => 'usesomesillystringforsalt' ];

$dataArray = array();

$dataArray['flexRadioDefault'] = $_POST['flexRadioDefault'];
$dataArray['name'] = $_POST['name'];
$dataArray['email'] = $_POST['email'];
$dataArray['passwort'] = password_hash($_POST['passwort'], PASSWORD_BCRYPT, $options);
$dataArray['datum'] = $_POST['datum'];
$dataArray['strasse'] = $_POST['strasse'];
$dataArray['wohnort'] = $_POST['wohnort'];
$dataArray['plz'] = $_POST['plz'];
$dataArray['bundesland'] = $_POST['bundesland'];
$dataArray['tel'] = $_POST['tel'];
$dataArray['file'] = $_FILES['file']['name'];

$uploaddir = './uploads/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);

$fp = fopen('file.csv', 'a') or die("error");

fputcsv($fp, $dataArray, ";");

fclose($fp);

echo '<pre>';
//if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
//    echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
//} else {
//    echo "Möglicherweise eine Dateiupload-Attacke!\n";
//}

print "</pre>";

$server = 'localhost';
$username = 'pma';
$password = 'Will0fth3W1sps';
$database = 'html_db';

try{
    
    //$connection = new PDO('mysql:host=myjesussqlserver.mysql.database.azure.com;port=3306;dbname=html_db', 'tobiasollmaier', $password);
    $connection = mysqli_init(); 
    mysqli_ssl_set($connection,NULL,NULL, "https://webapptobias.azurewebsites.net/DigiCertGlobalRootCA.crt.pem", NULL, NULL); 
    mysqli_real_connect($connection, "myjesussqlserver.mysql.database.azure.com", "tobiasollmaier", "W1ll0fth3W1sps", "html_db", 3306, MYSQLI_CLIENT_SSL);
    // EXCEPTION konfigurieren
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtplz = $connection->prepare ("INSERT INTO plz (plz, wohnort, bundesland)
        VALUES (:plz, :wohnort, :bundesland)");

    $stmtplz->bindParam(':plz', $_POST["plz"]);
    $stmtplz->bindParam(':wohnort', $_POST["wohnort"]);
    $stmtplz->bindParam(':bundesland', $_POST["bundesland"]);
    $stmtplz->execute();
    echo ('<p>Eintrag PLZ erfolgreich</p>');

    $stmtadresse = $connection->prepare ("INSERT INTO adresse (strasse, plz_idplz)
    VALUES (:strasse, LAST_INSERT_ID())");
    $stmtadresse->bindParam(':strasse', $_POST["strasse"]);
    $stmtadresse->execute();
    echo ('<p>Eintrag Adresse erfolgreich</p>');

    $stmtuser = $connection->prepare ("INSERT INTO user (name, anrede, email, geburtstag, passwort, tel_nr, file, adresse_idadresse)
    VALUES (:name, :anrede, :email, :geburtstag, :passwort, :tel_nr, :file, LAST_INSERT_ID())");
    $stmtuser->bindParam(':name', $_POST["name"]);
    $stmtuser->bindParam(':anrede', $_POST["flexRadioDefault"]);
    $stmtuser->bindParam(':email', $_POST["email"]);
    $stmtuser->bindParam(':geburtstag', $_POST["datum"]);
    $stmtuser->bindParam(':passwort', password_hash($_POST['passwort'], PASSWORD_BCRYPT, $options));
    $stmtuser->bindParam(':tel_nr', $_POST["tel"]);
    $stmtuser->bindParam(':file', $_FILES['file']['name']);
    $stmtuser->execute();
    echo ('<p>Eintrag User erfolgreich</p>');

    }
    catch(PDOException $e)
     {
     echo ( 'Fehler: ' . $e->getMessage());
     }
    $connection = null;

    session_start();
    echo 'Hi, ' . $_SESSION["email"] . ' ' . $_SESSION["passwort"];
    echo file_get_contents("index.html");
?>