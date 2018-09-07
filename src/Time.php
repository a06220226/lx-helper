<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/9/7 14:40
 * doc: 时间处理类
 *+++++++++++++++++++++++++++++
 */

namespace a06220226\helper;

class Time
{
    /**
     * 某天开始和结束时间
     * @param $which int 正数表示后几天 负数表示前几天
     * @param $is_time bool true表示返回时间戳  false返回日期
     * @return array
     */
    public static function getDay($which=0,$is_time=false)
    {
        $date=[
            date('Y-m-d',strtotime($which . ' day')),
            date('Y-m-d 23:59:59',strtotime($which . ' day'))
        ];
        if($is_time){
            return  [strtotime($date[0]),strtotime($date[1])];
        }else{
            return $date;
        }
    }

    /**
     * 某周开始和结束时间,周一到周末
     * @param $which int 正数表示后面几周 负数表示前几周
     * @param $is_time bool true表示返回时间戳  false返回日期
     * @return array
     */
    public static function getWeek($which=0,$is_time=false)
    {
        $date=[
            date('Y-m-d',strtotime(($which - 1) . ' week Monday')),
            date('Y-m-d 23:59:59', strtotime($which  . ' week Sunday')),
        ];
        if($is_time){
            return  [strtotime($date[0]),strtotime($date[1])];
        }else{
            return $date;
        }
    }

    /**
     * 某月开始和结束时间
     * @param $which int 正数表示后几月 负数表示前几月
     * @param $is_time bool true表示返回时间戳  false返回日期
     * @return array
     */
    public static function getMonth($which=0,$is_time=false)
    {
        $start_day=date('Y-m-01',strtotime($which . ' month'));
        $end_day=date('Y-m-d 23:59:59',strtotime('+1 month -1 day',strtotime($start_day)));
        if($is_time){
            return  [strtotime($start_day),strtotime($end_day)];
        }else{
            return [$start_day,$end_day];
        }
    }






}