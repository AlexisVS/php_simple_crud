<h1>Homepage</h1>

<?php

use Source\Helper;

// Helper::beautifful_print($users);
$className = "Controllers\UserController";
$class = new $className;
$test = call_user_func_array([$class, 'index'], []);
Helper::beautifful_print($test);
?>