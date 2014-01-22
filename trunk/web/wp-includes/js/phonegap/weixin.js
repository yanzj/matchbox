cordova.define("Weixin", function(require, exports, module) {
 
var exec = require('cordova/exec');

var Weixin = {
 
    registerApp : function(onSuccess,onError,appId,appName) {
        exec(onSuccess, onError, 'Weixin', 'registerApp', [appId,appName]);
    },
    setResponser :function(name){
        exec(null, null, 'Weixin', 'setResponser', [name]);
    },
    textContent : function(onSuccess, onError, types, text, options) {
        exec(onSuccess, onError, 'Weixin', 'textContent', [types,text,options]);     
    },
    imageContent : function(onSuccess, onError, types, imageUrl, options) {
        exec(onSuccess, onError, 'Weixin', 'imageContent', [types,imageUrl,options]);
    },
    musicContent : function(onSuccess, onError, types, musicUrl, options) {
        exec(onSuccess, onError, 'Weixin', 'musicContent', [types,musicUrl,options]);
    },
    videoContent : function(onSuccess, onError, types, videoUrl, options) {
        exec(onSuccess, onError, 'Weixin', 'videoContent', [types,videoUrl,options]);
    },
    webpageContent : function(onSuccess, onError, types, webpageUrl, options) {
        exec(onSuccess, onError, 'Weixin', 'webpageContent', [types,webpageUrl,options]);
    },
    APPContent : function(onSuccess, onError, types, options) {
        exec(onSuccess, onError, 'Weixin', 'APPContent', [types,options]);
    },
    cancleGet : function(){
        exec(null,null,'Weixin','cancleGet',[]);
    },
    getWXAppInstallUrl : function(onSuccess, onError){
        exec(onSuccess,onError,'Weixin','getWXAppInstallUrl',[]);
    },
    openWXApp : function(onSuccess,onError){
        exec(onSuccess,onError,'Weixin','openWXApp',[]);
    },
    isWeixinInstalled : function(onSuccess,onError){
        exec(onSuccess,onError,'Weixin','isWeixinInstalled',[]);
    },
    isSupportApi : function(onSuccess,onError){
        exec(onSuccess,onError,'Weixin','isSupportApi',[]);
    }
};

module.exports =Weixin;
});


document.addEventListener("deviceready",onDeviceReady,false);
//微信发送
send_weixin = function(title, url, desc, pic){
	
    var sendType=0 ; //好友
    onConfirm_wx = function(e){
		if(e == 2) {
			sendType =1;
		}
		console.log("send..");
		Weixin.webpageContent(
			onSuccess,onError,"send",
             url,
            {
            	title:title,
                description:desc,
                thumbUrl:pic,
                scene:sendType
             });
		
		console.log("send 完成");
	};

	navigator.notification.confirm(
        '发送到哪里', // message
         onConfirm_wx,            // callback to invoke with index of button pressed
        '微信发送',           // title
        ['好友','朋友圈']         // buttonLabels
    );
}
function onSuccess(){
   console.log('success');
};

function onError(response){
    console.log('error' +response );
};


function onDeviceReady()
{
        registerApp();
    //    setResponse();
        console.log("device ok");
}

function registerApp(){
    Weixin.registerApp(function(){
                            registed=true;
                            console.log("reg ok");
                            navigator.splashscreen.hide();
                            },onError,"wx9dafc063c6f7f2f5","火柴盒");
}