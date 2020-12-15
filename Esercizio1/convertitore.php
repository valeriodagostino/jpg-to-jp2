<?php

    //ESERCIZIO 1

    //CARTELLA DELLE IMMAGINI
    $directory = dirname($_SERVER['SCRIPT_FILENAME']) . "/img";

    echo "<h1>I file da convertire devo essere inseriti nella cartella: " . $directory ."</h1>";

    //GENERA UNA STRUTTURA AD ALBERO DI TUTTA LA CARTELLA
    $rdi = new RecursiveDirectoryIterator($directory);
    //LEGGE LA STRUTTURA DELLA CARTELLA
    $rii = new RecursiveIteratorIterator($rdi);

    foreach ( $rii as $file ) {

        if ( $file->isDir() ) { continue; }

        //INFORMAZIONI DEI FILE PRESENTI NELLA CARTELLA O NELLE SOTTOCARTELLE
        $filename = $file->getFilename();
        $filepath = $file->getPathname();
        $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $name = pathinfo($filename, PATHINFO_FILENAME);
        
        //ESCLUDE TUTTI I FILE TRANNE I FORMATI JPG O JPEG
        if ( ! in_array( mime_content_type( $file->getPathname() ), array(
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
        ) ) ) { continue; }

        $newdir = dirname($filepath);
        
        //CONVERTE TUTTI I FILE JPG O JPEG IN JPEG 2000 (JP2)
        $img = new Imagick($filepath);
        $img->setImageFormat('jp2');
        $img->setImageCompression(Imagick::COMPRESSION_JPEG2000);
        $img->setImageCompressionQuality(40);
        $img->stripImage();
        //LI SALVA NELLA STESSA CARTELLA IN CUI SI TROVAVANO
        $img->writeImages($newdir . '/' . $name . '.jp2' , true);

        $newfile = $newdir . '/' . $name . '.jp2';
        
        //CONTROLLA SE LA CONVERSIONE E' AVVENUTA CON SUCCESSO
        if(file_exists($newfile)){
            echo "<ul><li>";
            echo "<h3>Immagine convertita con successo!  <br></h3>";
            echo "<h3>Immagine salvata nella cartella: " . $newfile . "</h3>";
            //unlink($filepath);
            echo "</li></ul>";
        }
        else{
            echo "<h3>Errore: Immagine non convertita.</h3>";
        }
    }

?>
