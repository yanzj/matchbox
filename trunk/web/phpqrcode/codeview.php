<?php 
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'temp/';
    include "qrlib.php";    
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

    $filename = $PNG_TEMP_DIR.'test.png';
    
    $errorCorrectionLevel = 'H';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 8;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
  
   if (isset($_REQUEST['data'])) { 
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    }    
	
	$_imgsrc = $PNG_WEB_DIR.basename($filename);
    //echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" alt="'.$PNG_WEB_DIR.basename($filename).'"/>';  

    //QRtools::timeBenchmark();    
?>  
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
	html { margin:0 auto;padding:0;}
</style>
</head>
<body>
<div style="width:100%;text-align: center;vertical-align: middle;">
	<!-- <p>扫描二维码在移动设备上预览文章</p> -->
	<img src="<?php echo $_imgsrc;?>"/>
	<p><input type="text" style="width:360px;text-align:center;" value="<?php echo $_REQUEST['data']?>"/></p>
</div>
</body>
</html>
