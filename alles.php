<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formular</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
<style>

</style>  
</head>
  <body class="container">    
    <h1>Formular</h1>
    <fieldset>
      <legend>
        Treffen Sie ein Auswahl:
      </legend>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="radio" id="alle" name="radio_kunden" value="1" checked>
        <label for="alle">Alle Kunden</label><br>
        <input type="radio" id="letze_m" name="radio_kunden" value="2">
        <label for="alle">Letzte Monat</label><br>
        <input type="radio" id="aktuelle_m" name="radio_kunden" value="3">
        <label for="alle">Aktuelle Monat</label><br>
        <input type="radio" id="nachste_m" name="radio_kunden" value="4">
        <label for="alle">Nächste Monat</label><br><br>
        <button type="submit" name="absenden">Ok</button>
    </form>
  </fieldset><br><br>
  <div>
  <?php
  if (isset($_POST["absenden"])){
$username = "root"; 
$passwort = ""; 
$datenbank = "dblap"; 
$mysqli = new mysqli("localhost", $username, $passwort, $datenbank); 
$query = "SELECT * FROM tblkunden";

$month = date('m');
$month = $month*1;
$auswahl = $_POST["radio_kunden"];

switch($auswahl) {
    case 1:
        break;
    case 2:
        if($month == 1) {
            $month = 12;
        }
        else {
            $month = $month-1;
        }        
        $query .= " WHERE month(geburtstag) = $month"; // .= --> Concat
        break;

    case 3:
        $query .= " WHERE month(geburtstag) = $month";
        break;

    case 4:
        if($month == 12) {
            $month = 1;
        }
        else {
            $month = $month+1;
        }            
        $query .= " WHERE month(geburtstag) = $month";
        break;
}


echo '<table border=1>';
echo '<thead>
<tr>
<th>Anrede</th>
<th>Titel</th>
<th>Vorname</th>
<th>Nachname</th>
<th>Titel 2</th>
<th>Geburtstag</th>
<th>Strasse</th>
<th>PLZ</th>
<th>Ort</th>
</tr>
</thead>
<tbody>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $anrede = $row["anrede"];
        $vorname = $row["vorname"];
        $nachname = $row["nachname"];
        $geburtstag = $row["geburtstag"];
        $titel = $row["titel"];
        $titel2 = $row["titel2"];
        $strasse = $row["strasse"];
        $plz = $row["plz"];
        $ort = $row["ort"];
        $id = $row["idtblKunden"];

        echo '<tr> 
                  <td>'.$anrede.'</td> 
                  <td>'.$titel.'</td>
                  <td>'.$vorname.'</td>
                  <td>'.$nachname.'</td>
                  <td>'.$titel2.'</td> 
                  <td>'.$geburtstag.'</td>
                  <td>'.$strasse.'</td> 
                  <td>'.$plz.'</td>
                  <td>'.$ort.'</td> 
              </tr>';
    }
}

echo '</tbody></table>';

}
?>
</div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
  
</body>
</html>
