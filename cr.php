<?php
/*
*author: Toserk
*email: toserk@aliyun.com
*vrsion: 7.0
*/
$domain = @$_REQUEST['host'];
$id = @$_REQUEST['id'];
$multi = @$_REQUEST['multi'];
$path = @$_REQUEST['path'];
$type = @$_REQUEST['type'];

$head = 'https://';
$api_path = '/api/v3/share/download/'; //网盘下载api路径

kong($domain, 'host');
kong($id, 'ID');

if ($multi == 'true' || $multi == '1') {
 kong($path, 'path');
 $file_path = '?path=' . $path;
} 
else if($multi == '') {
 $file_path = '?path=undefined%2Fundefined';
} else {
 error(403, 'mulit参数输入错误');
}
//拼接请求url
$url = $head . $domain . $api_path . $id . $file_path;

$respond_body = request($url);
$respond_data=json_decode($respond_body, true);
$respond_code = $respond_data['code'];

if ($respond_code == '0') {
 $down_url = $respond_data['data'];
 if ($type == 'down') {
  header("Location: {$down_url}", true, 302);
 }
else {
 http_response_code(200);
 header('Content-Type: application/json');
 $return_data = json_encode([
   'code' => 200,
   'message' => '解析成功',
   'download' => $down_url,
  ],JSON_UNESCAPED_UNICODE);
 $return= str_replace("\/","/",$return_data);
  echo $return;
 }
} else {
  error(404, '解析失败，请检查参数是否输入正确');
}

function kong($data, $text) {
 if ($data == '') {
  http_response_code(403);
  header('Content-Type: application/json');
  $error = json_encode([
   'code' => 403,
   'message' => "{$text}参数输入为空",
  ],JSON_UNESCAPED_UNICODE);
  echo $error;
  exit;
 }
}

function error($code, $message) {
 http_response_code($code);
 header('Content-Type: application/json');
 $error = json_encode([
  'code' => $code,
  'message' => $message,
 ],JSON_UNESCAPED_UNICODE);
 echo $error;
 exit;
}

function request($url){
    $request = curl_init();
    
    $header[] = "accept: application/json, text/plain, */*";
    
    curl_setopt($request, CURLOPT_URL, $url);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($request, CURLOPT_PUT, 1);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($request, CURLOPT_HEADER, $header);
    curl_setopt($request, CURLOPT_TIMEOUT, 8);  //请求超时时间
    
    $respond= curl_exec($request); 
    if ($respond === false) {  
        error(500, '请求失败，请确保网盘运行正常');
    }  
    $headersize = curl_getinfo($request, CURLINFO_HEADER_SIZE);
    $respond_body = substr($respond, $headersize); 
    curl_close($request);
    return $respond_body;
}