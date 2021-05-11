<?php
require_once 'constante.php';
class telechargement
{

    public static function telecharge($fichier, $extension, $dossierCible)
    {
        $fichier_dir = ROOT_DIR . '/'.$dossierCible.'/';
        $fichier_basename = basename($fichier['name']);
        $fichier_chemin = $fichier_dir . $fichier_basename;
        $fichier_ok = 1;
        $fichierType = strtolower(pathinfo($fichier_chemin, PATHINFO_EXTENSION));


        // Check if file already exists + renomage 
        $fichier_basename = substr(md5($fichier_basename), 10) . ".$fichierType";
        $fichier_chemin = $fichier_dir . $fichier_basename;
        while (file_exists($fichier_chemin)) {
            $fichier_basename = mt_rand(0, 9) . $fichier_basename;
            $fichier_chemin = $fichier_dir . $fichier_basename;
        }

        // Check file size
        if ($fichier["size"] > 10000000) {
            echo ' <div class="alert alert-danger text-center" role="alert">Sorry, your file is too large.</div>';
            $fichier_ok = 0;
        }
        // Allow certain file formats
        if (!in_array($fichierType, $extension)) {
            echo ' <div class="alert alert-primary text-center" role="alert">Sorry, extension non autorisé.</div>';
            $fichier_ok = 0;
        }
        // Check if $fichier_Ok is set to 0 by an error
        if ($fichier_ok == 0) {
            echo ' <div class="alert alert-primary text-danger text-center" role="alert"> your file was not uploaded.</div>';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fichier["tmp_name"], $fichier_chemin)) {

                return ['ok' => 1, 'nom' => $fichier_basename, 'alert' => ' <div class="alert alert-primary text-center" role="alert">The file ' . htmlspecialchars(basename($fichier_basename)) . ' has been uploaded.</div>'];
            } else {
                echo ' <div class="alert alert-primary text-center" role="alert">Sorry, there was an error uploading your file.</div>';
            }
        }
    }
}
