<?php

$path = CLBS_DIR_PATH . "/config/inc";

if (!is_dir($path)) {
    die("Le répertoire spécifié n'existe pas : $path");
}

$files = array_diff(scandir($path), array('.', '..'));
// Uniquement les fichiers php
$files = array_filter($files, function($file) use ($path) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'php';
});

foreach ($files as $file) {
    $filePath = ($path . "/" . $file);

    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "Impossible de charger le fichier : $file" . PHP_EOL;
    }

    // affhice nomController::getInstance();
    $file_name = str_replace(".php", "", $file);
    if(class_exists($file_name) && method_exists($file_name, "getInstance"))
    {
        $file_name::getInstance();
    }
}