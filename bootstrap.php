<?php
/* 
 * Make sure all of the paths here are correct for your setup
 */

/**
 * @author mvdkleijn
 */

// TODO: check include path
ini_set('include_path', ini_get('include_path')
                        .PATH_SEPARATOR.dirname(__FILE__).'/../../../../../opt/lampp/lib/php/PHPUnit'
                        .PATH_SEPARATOR.dirname(__FILE__).'/../src'
                        .PATH_SEPARATOR.dirname(__FILE__).'/../src/wolf');

require_once 'PHPUnit/Framework.php';

$_SERVER['HTTP_HOST'] = 'localhost';

require_once 'Framework.php';


// Database settings:
define('DB_DSN', 'mysql:dbname=wolf_phpunit;host=127.0.0.1;port=3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('TABLE_PREFIX', '');



?>
