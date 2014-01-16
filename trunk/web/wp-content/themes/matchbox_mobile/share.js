// add for phonegap 
var appId = 'wx9dafc063c6f7f2f5'; //please modify to your weichat application ID 
function onBodyLoad()
{		
    document.addEventListener("deviceready", onDeviceReady, false);
}

function onDeviceReady()
{
    registerApp();
}

function onSuccess(){
    console.log('success');
}

function onError(response){
    console.log('error');
    
}

function sendWebpageContent(url,title,desc,sendType){
    Weixin.webpageContent(onSuccess,onError,"send",
                                   url,
                                   {
                                   title:title,
                                   description:desc,
                                   thumbUrl:"",//固定的图片?
                                   scene:sendType || 0  //没有给就是0
                                   });
}
function send_weixin(){
		var post_id	= jQuery('#favorite_current_post_id').val();
		var post_title = jQuery('#mb_post_title_' + post_id).val();
		
		sendWebpageContent(post_id, post_title);
}
/*******************************************************************************/