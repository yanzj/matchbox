<?php
 /**  * QR Code + Logo Generator QR图片中间加logo，QR是根据google开放api生成的，其实啥都没有
   *    * http://labs.nticompassinc.com     */  //ini_set("auto_detect_line_endings", true);
  
  $data = isset($_GET['data']) ? $_GET['data'] : 'http://weixin.qq.com/r/8bxsY6LEqpzVh7MAn_nV';
  $size = isset($_GET['size']) ? $_GET['size'] : '200x200';
  $logo = isset($_GET['logo']) ? $_GET['logo'] : './logo.jpg';//中间那logo图
  // Get QR Code image from Google Chart API
  // http://code.google.com/apis/chart/infographics/docs/qr_codes.html
  //https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
  $png = "http://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Hello+world&chld=L|1&choe=UTF-8";
  $QR = imagecreatefrompng($png);//Warning: imagecreatefrompng() [function.imagecreatefrompng]: Unable to find the wrapper "https" - did you forget to enable it when you configured PHP? =
  //$QR = imagecreatefrompng('./chart.png');//外面那QR图
  if($logo !== FALSE):
   $logo = imagecreatefromstring(file_get_contents($logo));
  
   $QR_width = imagesx($QR);
   $QR_height = imagesy($QR);
       
   $logo_width = imagesx($logo);
   $logo_height = imagesy($logo);
          
   // Scale logo to fit in the QR Code
   $logo_qr_width = $QR_width/5;
   $scale = $logo_width/$logo_qr_width;
   $logo_qr_height = $logo_height/$scale;
   $from_width = ($QR_width-$logo_qr_width)/2;
   //echo $from_width;exit;
   imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
  endif;
  header('Content-type: image/png');
  imagepng($QR);
  imagedestroy($QR);
 ?>