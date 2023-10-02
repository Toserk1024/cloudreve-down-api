<h3>1.介绍：</h3><br>
 此脚本可以通过用户所输入的云盘域名，分享ID，(如果分享里面有多个文件，那么就需要用户输入文件路径)来获取使用Cloudreve程序所搭建的网盘的文件直链地址，理论上只要是Cloudreve程序搭建的网盘，都是可以通用的，除非是一些远古或者魔改版本。<br>
注：目前暂不支持自动获取文件列表以及自动匹配分享链接(一个字：懒)

<h3>2.示例：</h3><br>
例如：api.example.com/cr.php?host=pan.example.com&id=LKoM&type=down&multi=1&path=/test.txt

注：为避免有人滥用解析服务，暂不提供在线服务，请自行搭建。

<h3>3.参数说明：</h3><br>
 <strong>1.host：</strong>Cloudreve网盘域名<br>
<strong> 2.id：</strong>分享ID，在分享链接中，有一串随机的字符串，那就是分享ID。<br>
 <strong>3.type：</strong>返回方式，type为down时直接302跳转，其他字符都是json返回<br>
 <strong>4.multi：</strong>多文件模式，当一个分享里面有多个文件那么需要开启此模式，需要输入true或者1，不可输入其他字符，不强制要求填写。<br>
 <strong>5.path：</strong>多文件时的文件路径，如分享的目录下面有多个文件，如果想要下载test.txt，那么就要输入/text.txt。如果该分享下有文件夹，那就同理/path/test.txt，在多文件模式开启的时候必须填写<br>

<h3>4.结尾：</h3><br>
本人刚刚初二(实际上这个脚本是初一的时候写的，最近发现这个脚本，稍稍的重构了一下，顺便开个源)，写的不好，不喜勿喷，也欢迎各位大佬指出错误。
