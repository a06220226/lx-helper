<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/8/22 14:16
 * doc: 验证类
 *+++++++++++++++++++++++++++++
 */


namespace a06220226\helper;


class Regulars {

    //手机号验证
    public static function isMobile($mobile)
    {
        if(strlen($mobile) != 11)   return  false;
        return  preg_match('/^1\d{10}$/',$mobile) ? true : false;
    }

    //是否全是中文
    public static function isAllChinese($str)
    {
        return  preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str) ? true : false;
    }

    //是否包含中文
    public static function hasChinese($str)
    {
        return  preg_match('/[\x{4e00}-\x{9fa5}]+/u',$str) ? true : false;
    }

    //邮箱验证
    public static function isEmail($email)
    {
        return  filter_var($email,FILTER_VALIDATE_EMAIL);
    }

    //url验证
    public static function isUrl($url)
    {
        return filter_var($url,FILTER_VALIDATE_URL);
    }

    //IP验证
    public static function isIp($ip)
    {
        return  filter_var($ip,FILTER_VALIDATE_IP);
    }

    //身份证验证
    public static function isIdCard($id_card)
    {
        if(strlen($id_card) != 15 && strlen($id_card) != 18){
            return  false;
        }

        strlen($id_card) == 15 && $id_card=self::idcard_15to18($id_card);

        return  self::idcard_checksum18($id_card);
    }

    // 计算身份证校验码，根据国家标准GB 11643-1999
    private static function idcard_verify_number($idcard_base)
    {
        if(strlen($idcard_base) != 17){
            return false;
        }
        //加权因子
        $factor=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
        //校验码对应值
        $verify_number_list=array('1','0','X','9','8','7','6','5','4','3','2');
        $checksum=0;
        for($i=0;$i<strlen($idcard_base);$i++){
            $checksum += substr($idcard_base,$i,1) * $factor[$i];
        }
        $mod=$checksum % 11;
        $verify_number=$verify_number_list[$mod];
        return $verify_number;
    }

    // 将15位身份证升级到18位
    private static function idcard_15to18($id_card)
    {
        if(strlen($id_card) != 15){
            return false;
        }else{
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if(array_search(substr($id_card,12,3),array('996','997','998','999')) !== false){
                $idcard=substr($id_card,0,6).'18'.substr($id_card,6,9);
            }else{
                $idcard=substr($id_card,0,6).'19'.substr($id_card,6,9);
            }
        }
        return $idcard . (self::idcard_verify_number($idcard));
    }

    // 18位身份证校验码有效性检查
    private static function idcard_checksum18($id_card)
    {
        if(strlen($id_card) != 18){
            return false;
        }
        $idcard_base=substr($id_card,0,17);
        return self::idcard_verify_number($idcard_base) == strtoupper(substr($id_card,17,1));
    }

}