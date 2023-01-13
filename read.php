<?php

require('config.php');
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "De verbinding is gelukt";
    } else {
        echo "Interne server-error";
    }
  } catch(PDOException $e) {
    echo $e->getMessage();
  }


  $sql = "SELECT Id
                ,Merk
                ,Model
                ,Topsnelheid
                ,Prijs
          FROM DureAuto
          ORDER BY Prijs DESC";

$statement = $pdo->prepare($sql);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_OBJ);

// var_dump($result);

$rows = "";
foreach ($result as $info) {
  $rows .= "<tr>
              <td>$info->Id</td>
              <td>$info->Merk</td>
              <td>$info->Model</td>
              <td>$info->Topsnelheid</td>
              <td>$info->Prijs</td>
              <td>
                  <a href='delete.php?Id=$info->Id'>
                      <img src='img/b_drop.png' alt='kruis'>
                  </a>
              </td>
            </tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RichestPeople</title>
</head>
<body>
    <h3>De vijf duurste auto's ter wereld</h3>
    <table border='1'>
        <thead>
            <th>Id</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Topsnelheid</th>
            <th>Prijs</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?= $rows; ?>
        </tbody>
    </table>
</body>
</html>