<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/8/22 11:36
 * doc: 
 *+++++++++++++++++++++++++++++
 */

require_once './vendor/autoload.php';

use a06220226\helper\Test;

$test=new Test();

$test->sayGoodBye();

use a06220226\helper\Regulars;

$test=new Regulars();

var_dump($test->isIdCard('130303198011212115'));
