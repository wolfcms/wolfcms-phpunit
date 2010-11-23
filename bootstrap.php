<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author mvdkleijn
 */

// TODO: check include path
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(__FILE__).'/../../../../../opt/lampp/lib/php/PHPUnit'.PATH_SEPARATOR.dirname(__FILE__).'/../src'.PATH_SEPARATOR.dirname(__FILE__).'/../src'.PATH_SEPARATOR.dirname(__FILE__).'/../src/wolf');
//ini_set("include_path", "../src/wolf/app/models".PATH_SEPARATOR."../../../../src/wolf/app/models".PATH_SEPARATOR.ini_get("include_path"));
require_once 'PHPUnit/Framework.php';
require_once 'Framework.php';


// Database settings:
define('DB_DSN', 'mysql:dbname=wolf_phpunit;host=127.0.0.1;port=3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('TABLE_PREFIX', '');



?>
