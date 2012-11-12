<?php
/* 
 * Make sure all of the paths here are correct for your setup
 */

/**
 * @author mvdkleijn
 */

// TODO: check include path
ini_set('include_path', ini_get('include_path')
                        .PATH_SEPARATOR.dirname(__FILE__).'/../src'
                        .PATH_SEPARATOR.dirname(__FILE__).'/../src/wolf'
                        .PATH_SEPARATOR.dirname(__FILE__).'/../src/wolf/app/models'
                        .PATH_SEPARATOR.dirname(__FILE__).'/..'
                        .PATH_SEPARATOR.dirname(__FILE__).'/../wolf'
                        .PATH_SEPARATOR.dirname(__FILE__).'/../wolf/app/models');

define('BASE_URL', '');

require_once 'Framework.php';

$dbtest = getenv('DB');

// Database settings:

if ($dbtest == 'mysql') {
    define('DB_DSN', 'mysql:dbname=wolfcms_test;host=127.0.0.1;port=3306');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}

if ($dbtest == 'postgres') {
    define('DB_DSN', 'pgsql:dbname=wolfcms_test;host=127.0.0.1;port=5432');
    define('DB_USER', 'postgres');
    define('DB_PASS', '');
}

if ($dbtest == 'sqlite') {
    define('DB_DSN', 'sqlite::memory:');
    define('DB_USER', null);
    define('DB_PASS', null);
}


define('TABLE_PREFIX', '');



?>
