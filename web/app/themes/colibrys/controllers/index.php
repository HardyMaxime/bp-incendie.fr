<?php

$path = CLBS_DIR_PATH . "/controllers/includes";

if (!is_dir($path)) {
    die("Le répertoire spécifié n'existe pas : $path");
}

$controllers = array_diff(scandir($path), array('.', '..'));
// Uniquement les fichiers php
$controllers = array_filter($controllers, function($file) use ($path) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'php';
});

foreach ($controllers as $controller) {
    $filePath = ($path . "/" . $controller);

    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "Impossible de charger le fichier : $controller" . PHP_EOL;
        continue;
    }

    // affhice nomController::getInstance();
    $controller_name = str_replace(".php", "", $controller);
    if(class_exists($controller_name) && method_exists($controller_name, "getInstance"))
    {
        $controller_name::getInstance();
    }
}