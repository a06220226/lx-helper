<?php
/*+++++++++++++++++++++++++++++
 * Created by PhpStorm
 * User: a06220226
 * Date: 2018/9/12 17:24
 * doc: 文件下载类
 *+++++++++++++++++++++++++++++
 */


namespace a06220226\helper;


class DownFile {

    /**
     * 下载csv文件到浏览器
     * @param $filename string 文件名或路径
     * @param $data array 数据
     * @param $title array 标题
     * @return string|bool
     */
    public static function downCsvToBrowser($filename,$data,$title=[])
    {
        if(empty($data) && empty($title))    return  '无数据！';
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:filename=" . iconv("UTF-8", "gbk", self::get_basename($filename) ) );
        return  self::writeCsvData('php://output',$data,$title);
    }

    /**
     * 下载csv文件到本地服务器
     * @param $filename string 文件名或路径
     * @param $data array 数据
     * @param $title array 标题
     * @return string|bool
     */
    public static function downCsvToLocal($filename,$data,$title=[])
    {
        if(empty($data) && empty($title))    return  '无数据！';
        return  self::writeCsvData($filename,$data,$title);
    }

    //将数据写入csv文件
    private static function writeCsvData($filename,$data,$title)
    {

        $fp = fopen($filename, 'w');

        //标题处理
        if(!empty($title)){
            $row=[];
            foreach ($title as $v) {
                $row[] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
            unset($title);
        }

        $cnt = 0;
        $limit = 100000;
        foreach ($data as $i => $v) {
            $cnt++;
            if ($limit == $cnt) {   //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = [];
            foreach ($v as $val) {
                $row[] = iconv('utf-8', 'gbk', $val);
            }
            fputcsv($fp, $row);
            unset($data['data'][$i]);
        }
        ob_flush();
        fclose($fp);
        return  true;
    }

    /**
     * 打包下载
     * @param $zip_name string zip文件的名字
     * @param $files array 需要打包下载的文件路径集合
     * @return string|bool
     */
    public static function downZip($zip_name,$files)
    {
        if(file_exists($zip_name))    @unlink($zip_name);

        $zip = new \ZipArchive();//使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
        if ($zip->open($zip_name, \ZIPARCHIVE::CREATE)!==TRUE) {
            return  '创建ZIP文件失败！';
        }
        foreach( $files as $val){
            if(file_exists($val)){
                $zip->addFile( $val, iconv('UTF-8','GBK',self::get_basename($val)) );
            }
        }
        $zip->close();//关闭

        if(!file_exists($zip_name)){return 'ZIP文件读取失败！';}
        self::download($zip_name);
        return true;
    }

    //解决basename不能获取中文的问题
    private static function get_basename($filename){
        $name=explode('/',$filename);
        return  array_pop($name);
    }

    /**
     * 下载本地文件
     * @param $filename string 文件路径
     * @return null
     */
    public static function download($filename)
    {
        header("Content-type: application/octet-stream");
        header( 'Content-Disposition:  attachment;  filename=' . self::get_basename($filename) ); //告诉浏览器通过附件形式来处理文件
        header('Content-Length: ' . filesize($filename)); //下载文件大小
        ob_clean();
        flush();
        @readfile($filename);  //读取文件内容
    }
    
}