# 常用的公共方法

> helper常用方法

* element()
* elements()

> Regulars各种验证方法

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





