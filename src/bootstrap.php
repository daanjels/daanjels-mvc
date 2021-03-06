<?php
// load config
require_once 'config/config.php';
// load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/image_helper.php';

// autoload core libraries : this loads all the classes in the libraries directory
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});