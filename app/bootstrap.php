<?php
require_once 'config/config.php';

function autoload($className) {
    if (file_exists(APPROOT . '/libraries/' . $className . '.php')) {
        require_once APPROOT . '/libraries/' . $className . '.php';
    } elseif (file_exists(APPROOT . '/models/' . $className . '.php')) {
        require_once APPROOT . '/models/' . $className . '.php';
    }
}
spl_autoload_register('autoload');
?>