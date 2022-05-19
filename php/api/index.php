<?php
// 1.读取2.txt中的内容，并以换行符分开
$str = explode("\n", file_get_contents('https://ramkoishi-plus.vercel.app/1.txt'));
// 2.得到的$str是一个String的数组，然后获取随机数index
$rand_index = rand(0,count($str)-1);
// 根据生成的随机数选取index为$rand_index的图片链接
$url = $str[$rand_index];
// 替换掉转义
$url = str_re($url);
// 3.重定向到目标url,返回302码,然后浏览器就会跳转到图片url的地址
header("Location:".$url);
// 替换掉一些换行、制表符等转义
function str_re($str){
    $str = str_replace(' ', "", $str);
    $str = str_replace("\n", "", $str);
    $str = str_replace("\t", "", $str);
    $str = str_replace("\r", "", $str);
    return $str;
  }
?>
