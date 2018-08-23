<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/8/23 10:30
 * doc: 
 *+++++++++++++++++++++++++++++
 */
 
require_once 'vendor/autoload.php';



$re=filter_var('aaaa1+1@163aa.com',FILTER_VALIDATE_EMAIL);

var_dump($re);