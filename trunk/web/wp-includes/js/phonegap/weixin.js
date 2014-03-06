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

