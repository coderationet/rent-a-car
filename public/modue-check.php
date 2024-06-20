<?php

// check required modules for laravel and its .htaccess file
$modules = array(
    'mod_rewrite',
    'mod_negotiation',
);

foreach ($modules as $module) {
    if (!extension_loaded($module)) {
        echo "The $module module is not loaded\n";
    }
}
