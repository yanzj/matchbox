// add for phonegap 
var appId = 'wx9dafc063c6f7f2f5'; //please modify to your weichat application ID 


function onDeviceReady()
{
	console.log('device ok....ing');
    registerApp();
    navigator.splashscreen.hide();
}
document.addEventListener("deviceready", onDeviceReady, false);

function onSuccess(){
    console.log('success');
}

function onError(response){
    console.log('error');
    
}

function sendWebpageContent(url,title,desc,png, sendType){
    Weixin.webpageContent(onSuccess,onError,"send",
                                   url,
                                   {
                                   title:title,
                                   description:desc,
                                   thumbUrl:"",//固定的图片?
                                   scene:sendType || 0  //没有给就是0
                                   });
}
function send_weixin(url,title,desc,png){
	sendWebpageContent(url,title,desc,png, 0);
}
//朋友圈
function send_friends(url,title,desc,png){
	sendWebpageContent(url,title,desc,png, 1);
}

function registerApp(){
    Weixin.registerApp(function(){
                            registed=true;
                            console.log("reg ok");
                            navigator.splashscreen.hide();
                            },onError,"wx9dafc063c6f7f2f5","火柴盒");
}

function openlink(url){
	//alert("open url " + url);
	var ref = window.open("http://"+url, '_system', 'location=yes');
}

/*******************************************************************************/