<?php

    require_once 'config.php';

    foreach (config::get('includes') AS $file) {
        $paths = config::get('paths');
        require_once $paths['base_path'] . $paths['includes'] . $file;
    }
