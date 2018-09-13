# 常用的公共方法

> helper常用方法

* element()
* elements()

> Regulars各种验证方法类

```
//手机号验证
\a06220226\helper\Regulars::isMobile($mobile)
//身份证号验证
\a06220226\helper\Regulars::isIdCard($id_card)
//字符串是否全是中文    
\a06220226\helper\Regulars::isAllChinese($str) 
//字符串是否包含中文   
\a06220226\helper\Regulars::hasChinese($str)     
//邮箱验证
\a06220226\helper\Regulars::isEmail($email)
//url验证
\a06220226\helper\Regulars::isUrl($url)
//IP验证
\a06220226\helper\Regulars::isIp($url)

```
> Time时间处理类

```
//某天开始和结束时间
\a06220226\helper\Time::getDay($which,$is_time)
//某周开始和结束时间,周一到周末
\a06220226\helper\Time::getWeek($which,$is_time)
//某月开始和结束时间
\a06220226\helper\Time::getMonth($which,$is_time)

```
> DownFile文件下载类

```
//下载csv文件到本地服务器
\a06220226\helper\DownFile::downCsvToLocal($filename,$data,$title)
//下载csv文件到浏览器
\a06220226\helper\DownFile::downCsvToBrowser($filename,$data,$title)
//文件打包下载
\a06220226\helper\DownFile::downZip($zip_name,$files)
//下载本地文件
\a06220226\helper\DownFile::download($filename)

```




