<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/8/22 13:52
 * doc: 
 *+++++++++++++++++++++++++++++
 */
 
if (!function_exists('element')){
    /**
     * 过滤数组单个元素，存在则直接返回，不存在则返回默认值
     * @param $item string 需要过滤的键名
     * @param $array array 原数组
     * @param $default mixed 默认值
     * @return mixed
     */
    function element($item, $array, $default = NULL)
    {
        return array_key_exists($item, $array) ? $array[$item] : $default;
    }
}

if (!function_exists('elements')){
    /**
     * 过滤数组多个元素，存在则直接返回，不存在则返回默认值
     * @param $items array 需要过滤的键名
     * @param $array array 原数组
     * @param $default mixed 默认值
     * @return array
     */
    function elements($items, $array, $default = NULL)
    {
        $return = array();

        is_array($items) OR $items = array($items);

        foreach ($items as $item)
        {
            $return[$item] = array_key_exists($item, $array) ? $array[$item] : $default;
        }

        return $return;
    }
}

if (!function_exists('dump')){
    /**
     * 浏览器友好的变量输出
     * @access public
     * @param  mixed       $var   变量
     * @param  boolean     $echo  是否输出(默认为 true，为 false 则返回输出字符串)
     * @param  string|null $label 标签(默认为空)
     * @param  integer     $flags htmlspecialchars 的标志
     * @return null|string
     */
    function dump($var, $echo = true, $label = null, $flags = ENT_SUBSTITUTE){
        $label = (null === $label) ? '' : rtrim($label) . ':';

        ob_start();
        var_dump($var);
        $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', ob_get_clean());

        if (PHP_SAPI == 'cli') {
            $output = PHP_EOL . $label . $output . PHP_EOL;
        } else {
            if (!extension_loaded('xdebug')) {
                $output = htmlspecialchars($output, $flags);
            }

            $output = '<pre>' . $label . $output . '</pre>';
        }

        if ($echo) {
            echo $output;
            return;
        }

        return $output;
    }
}

if (!function_exists('dd')){
    //打印数据并终止程序
    function dd($var){
        dump($var);
        exit();
    }
}

