<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/8/22 13:52
 * doc: 
 *+++++++++++++++++++++++++++++
 */
 
if(!function_exists('element')){
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

if(!function_exists('elements')){
    /**
     * 过滤数组元素，存在则直接返回，不存在则返回默认值
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

