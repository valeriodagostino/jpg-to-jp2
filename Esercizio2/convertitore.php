<?php

//ESERCIZIO 2

//CONTROLLA SE E' STATO PASSATO QUALCOSA IN INPUT DAL FORM
if(isset($_POST['submit']) && isset($_FILES["immagine"])){

    //VERIFICA SE IL FORMATO DEL FILE E' JPG O JPEG
    if($_FILES['immagine']['type'] == "image/jpeg"){
        
        $filename = $_POST['nomeimmagine'];
        $file = $_FILES['immagine']['tmp_name'];
        $directory = dirname($_SERVER['SCRIPT_FILENAME']);

         //CONVERTE L'IMMAGINE IN JPEG2000 (JP2)
        $img = new Imagick($file);
        $img->setImageFormat('jp2');
        $img->setImageCompression(Imagick::COMPRESSION_JPEG2000);
        $img->setImageCompressionQuality(40);
        $img->stripImage();
        //SALVA L'IMMAGINE NELLA CARTELLA DELLO SCRIPT
        $img->writeImages($directory . '/' . $filename . '.jp2' , true);

        $newfile = $directory . '/' . $filename . '.jp2';
        
        //CONTROLLA SE L'IMMAGINE E' STATA CONVERTITA CON SUCCESSO
        if(file_exists($newfile)){
            echo "<h1>Immagine convertita con successo!  <br><h1>";
            echo "<h1>Immagine salvata nella cartella: " . $newfile . "<h1>";
        }
        else{
            echo "<h1>Errore: Immagine non convertita.<h1>";
        }

    }
    else{
        echo "<h1>Il file selezionato non è una immagine jpg o jpeg.<h1>";
    }
}
else{
    echo "<h1>Non è stata caricata nessuna immagine.<h1>";
}



?>
