<html>

<!-- ESERCIZIO 3 -->

<head>
    <!-- CSS -->
    <style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 20%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
    </style>
</head>

<body>
<center>
<?php

    //DATI DATABASE
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "dbimg";
    $extension = ".jpg";
    $newextension = ".jp2";

    //CREAZIONE CONNESSIONE
    $conn = new mysqli($servername, $username, $password, $db);

    //CONTROLLO CONNESSIONE
    if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
    }
    echo "<h2>Connessione al database eseguita correttamente!</h2><br>";

    //SELEZIONE ELEMENTI DELLA TABELLA IMMAGINI
    $select = "SELECT * FROM immagini";          
    $results = $conn->query($select);
    if($results == true){
        echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>PERCORSO_IMG</th>
                    </tr>";
        while($row = $results->fetch_assoc()){
            echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['PERCORSO_IMG'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
    echo "<h2>Errore: " . $conn->error . "</h2>";
    }

    //SOSTITUZIONE ESTENSIONE
    $updateext = "UPDATE immagini SET PERCORSO_IMG = replace(PERCORSO_IMG, '$extension', '$newextension')";
    $sql = $conn->query($updateext);

    //CONTROLLO SOSTITUZIONE
    if($sql == true){
        echo "<h2>L'estensione dei file è stata cambiata con successo!</h2>";
    }else{
        echo "<h2>Errore: " . $conn->error . "</h2>";
    }


?>
</center>
</body>
</html>