/*! http://responsiveslides.com v1.53 by @viljamis */
(function(c,I,B){c.fn.responsiveSlides=function(l){var a=c.extend({auto:!0,speed:500,timeout:4E3,pager:!1,nav:!1,random:!1,pause:!1,pauseControls:!0,prevText:"Previous",nextText:"Next",maxwidth:"",navContainer:"",manualControls:"",namespace:"rslides",before:function(){},after:function(){}},l);return this.each(function(){B++;var f=c(this),s,r,t,m,p,q,n=0,e=f.children(),C=e.size(),h=parseFloat(a.speed),D=parseFloat(a.timeout),u=parseFloat(a.maxwidth),g=a.namespace,d=g+B,E=g+"_nav "+d+"_nav",v=g+"_here",j=d+"_on",w=d+"_s",k=c("<ul class='"+g+"_tabs "+d+"_tabs' />"),x={"float":"left",position:"relative",opacity:1,zIndex:2},y={"float":"none",position:"absolute",opacity:0,zIndex:1},F=function(){var b=(document.body||document.documentElement).style,a="transition";if("string"===typeof b[a])return!0;s=["Moz","Webkit","Khtml","O","ms"];var a=a.charAt(0).toUpperCase()+a.substr(1),c;for(c=0;c<s.length;c++)if("string"===typeof b[s[c]+a])return!0;return!1}(),z=function(b){a.before();F?(e.removeClass(j).css(y).eq(b).addClass(j).css(x),n=b,setTimeout(function(){a.after()},h)):e.stop().fadeOut(h,function(){c(this).removeClass(j).css(y).css("opacity",1)}).eq(b).fadeIn(h,function(){c(this).addClass(j).css(x);a.after();n=b})};a.random&&(e.sort(function(){return Math.round(Math.random())-0.5}),f.empty().append(e));e.each(function(a){this.id=w+a});f.addClass(g+" "+d);l&&l.maxwidth&&f.css("max-width",u);e.hide().css(y).eq(0).addClass(j).css(x).show();F&&e.show().css({"-webkit-transition":"opacity "+h+"ms ease-in-out","-moz-transition":"opacity "+h+"ms ease-in-out","-o-transition":"opacity "+h+"ms ease-in-out",transition:"opacity "+h+"ms ease-in-out"});if(1<e.size()){if(D<h+100)return;if(a.pager&&!a.manualControls){var A=[];e.each(function(a){a+=1;A+="<li><a href='#' class='"+w+a+"'>"+a+"</a></li>"});k.append(A);l.navContainer?c(a.navContainer).append(k):f.after(k)}a.manualControls&&(k=c(a.manualControls),k.addClass(g+"_tabs "+d+"_tabs"));(a.pager||a.manualControls)&&k.find("li").each(function(a){c(this).addClass(w+(a+1))});if(a.pager||a.manualControls)q=k.find("a"),r=function(a){q.closest("li").removeClass(v).eq(a).addClass(v)};a.auto&&(t=function(){p=setInterval(function(){e.stop(!0,!0);var b=n+1<C?n+1:0;(a.pager||a.manualControls)&&r(b);z(b)},D)},t());m=function(){a.auto&&(clearInterval(p),t())};a.pause&&f.hover(function(){clearInterval(p)},function(){m()});if(a.pager||a.manualControls)q.bind("click",function(b){b.preventDefault();a.pauseControls||m();b=q.index(this);n===b||c("."+j).queue("fx").length||(r(b),z(b))}).eq(0).closest("li").addClass(v),a.pauseControls&&q.hover(function(){clearInterval(p)},function(){m()});if(a.nav){g="<a href='#' class='"+E+" prev'>"+a.prevText+"</a><a href='#' class='"+E+" next'>"+a.nextText+"</a>";l.navContainer?c(a.navContainer).append(g):f.after(g);var d=c("."+d+"_nav"),G=d.filter(".prev");d.bind("click",function(b){b.preventDefault();b=c("."+j);if(!b.queue("fx").length){var d=e.index(b);b=d-1;d=d+1<C?n+1:0;z(c(this)[0]===G[0]?b:d);if(a.pager||a.manualControls)r(c(this)[0]===G[0]?b:d);a.pauseControls||m()}});a.pauseControls&&d.hover(function(){clearInterval(p)},function(){m()})}}if("undefined"===typeof document.body.style.maxWidth&&l.maxwidth){var H=function(){f.css("width","100%");f.width()>u&&f.css("width",u)};H();c(I).bind("resize",function(){H()})}})}})(jQuery,this,0);

/* FitVids 1.0.3 by Chris Coyier and Paravel  */
(function(a){"use strict";a.fn.fitVids=function(b){var c={customSelector:null},d=document.createElement("div"),e=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];return d.className="fit-vids-style",d.innerHTML="&shy;<style>               .fluid-width-video-wrapper {                 width: 100%;                              position: relative;                       padding: 0;                            }                                                                                   .fluid-width-video-wrapper iframe,        .fluid-width-video-wrapper object,        .fluid-width-video-wrapper embed {           position: absolute;                       top: 0;                                   left: 0;                                  width: 100%;                              height: 100%;                          }                                       </style>",e.parentNode.insertBefore(d,e),b&&a.extend(c,b),this.each(function(){var b=["iframe[src*='player.vimeo.com']","iframe[src*='www.youtube.com']","iframe[src*='www.youtube-nocookie.com']","iframe[src*='www.kickstarter.com']","object","embed"];c.customSelector&&b.push(c.customSelector);var d=a(this).find(b.join(","));d.each(function(){var b=a(this);if(!("embed"===this.tagName.toLowerCase()&&b.parent("object").length||b.parent(".fluid-width-video-wrapper").length)){var c="object"===this.tagName.toLowerCase()||b.attr("height")&&!isNaN(parseInt(b.attr("height"),10))?parseInt(b.attr("height"),10):b.height(),d=isNaN(parseInt(b.attr("width"),10))?b.width():parseInt(b.attr("width"),10),e=c/d;if(!b.attr("id")){var f="fitvid"+Math.floor(999999*Math.random());b.attr("id",f)}b.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*e+"%"),b.removeAttr("height").removeAttr("width")}})})}})(jQuery);

/* Hisrc jQuery Plugin */
(function($){$.hisrc={bandwidth:null,connectionTestResult:null,connectionKbps:null,connectionType:null,devicePixelRatio:null};$.hisrc.defaults={useTransparentGif:false,transparentGifSrc:"data:image/gif;base64,R0lGODlhAQABAIAAAMz/AAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",minKbpsForHighBandwidth:300,speedTestUri:"50K.jpg",speedTestKB:50,speedTestExpireMinutes:30,forcedBandwidth:false,srcIsLowResoltion:true};$.hisrc.speedTest=function(options){$(window).hisrc(options);};$.fn.hisrc=function(options){var settings=$.extend({callback:function(){}},$.hisrc.defaults,options),$els=$(this),connection=navigator.connection||{type:0},isSlowConnection=connection.type==3||connection.type==4||/^[23]g$/.test(connection.type);$.hisrc.devicePixelRatio=1;if(window.devicePixelRatio!==undefined){$.hisrc.devicePixelRatio=window.devicePixelRatio;}else{if(window.matchMedia!==undefined){for(var i=1;i<=2;i+=0.5){if(window.matchMedia("(min-resolution: "+i+"dppx)").matches){$.hisrc.devicePixelRatio=i;}}}}var speedTestUri=settings.speedTestUri,STATUS_LOADING="loading",STATUS_COMPLETE="complete",LOCAL_STORAGE_KEY="fsjs",speedConnectionStatus,initSpeedTest=function(){if(speedConnectionStatus){return;}if(settings.forcedBandwidth){$.hisrc.bandwidth=settings.forcedBandwidth;$.hisrc.connectionTestResult="forced";speedConnectionStatus=STATUS_COMPLETE;$els.trigger("speedTestComplete.hisrc");return;}if($.hisrc.devicePixelRatio===1){$.hisrc.connectionTestResult="skip";speedConnectionStatus=STATUS_COMPLETE;$els.trigger("speedTestComplete.hisrc");return;}$.hisrc.connectionType=connection.type;if(isSlowConnection){$.hisrc.connectionTestResult="connTypeSlow";speedConnectionStatus=STATUS_COMPLETE;$els.trigger("speedTestComplete.hisrc");return;}try{var fsData=JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY));if(fsData!==null){if((new Date()).getTime()<fsData.exp){$.hisrc.bandwidth=fsData.bw;$.hisrc.connectionKbps=fsData.kbps;$.hisrc.connectionTestResult="localStorage";speedConnectionStatus=STATUS_COMPLETE;$els.trigger("speedTestComplete.hisrc");return;}}}catch(e){}var speedTestImg=document.createElement("img"),endTime,startTime,speedTestTimeoutMS;speedTestImg.onload=function(){endTime=(new Date()).getTime();var duration=(endTime-startTime)/1000;duration=(duration>1?duration:1);$.hisrc.connectionKbps=((settings.speedTestKB*1024*8)/duration)/1024;$.hisrc.bandwidth=($.hisrc.connectionKbps>=settings.minKbpsForHighBandwidth?"high":"low");speedTestComplete("networkSuccess");};speedTestImg.onerror=function(){speedTestComplete("networkError",5);};speedTestImg.onabort=function(){speedTestComplete("networkAbort",5);};startTime=(new Date()).getTime();speedConnectionStatus=STATUS_LOADING;if(document.location.protocol==="https:"){speedTestUri=speedTestUri.replace("http:","https:");}speedTestImg.src=speedTestUri+"?r="+Math.random();speedTestTimeoutMS=(((settings.speedTestKB*8)/settings.minKbpsForHighBandwidth)*1000)+350;setTimeout(function(){speedTestComplete("networkSlow");},speedTestTimeoutMS);},speedTestComplete=function(connTestResult,expireMinutes){if(speedConnectionStatus===STATUS_COMPLETE){return;}speedConnectionStatus=STATUS_COMPLETE;$.hisrc.connectionTestResult=connTestResult;try{if(!expireMinutes){expireMinutes=settings.speedTestExpireMinutes;}var fsDataToSet={kbps:$.hisrc.connectionKbps,bw:$.hisrc.bandwidth,exp:(new Date()).getTime()+(expireMinutes*60000)};localStorage.setItem(LOCAL_STORAGE_KEY,JSON.stringify(fsDataToSet));}catch(e){}$els.trigger("speedTestComplete.hisrc");},setImageSource=function($el,src){if(settings.useTransparentGif){$el.attr("src",settings.transparentGifSrc).css("max-height","100%").css("max-width","100%").css("background",'url("'+src+'") no-repeat 0 0').css("background-size","contain");}else{$el.attr("src",src);}};settings.callback.call(this);$els.each(function(){var $el=$(this);var src=$el.attr("src");if(src){if(!$el.data("m1src")){$el.data("m1src",src);}if(!$el.attr("width")&&$el.width()>0){$el.attr("width",$el.width());}if(!$el.attr("height")&&$el.height()>0){$el.attr("height",$el.height());}$el.on("speedTestComplete.hisrc",function(){if(speedConnectionStatus===STATUS_COMPLETE){if(isSlowConnection){$el.attr("src",$el.data("m1src"));}else{if($.hisrc.devicePixelRatio>1&&$.hisrc.bandwidth==="high"){var image2x=$el.data("2x");if(!image2x){image2x=$el.data("m1src").replace(/\.\w+$/,function(match){return"@2x"+match;});}setImageSource($el,image2x);}else{if(settings.srcIsLowResoltion){var image1x=$el.data("1x");if(!image1x){image1x=$el.data("m1src").replace(/\.\w+$/,function(match){return"@1x"+match;});}setImageSource($el,image1x);}}}$el.off("speedTestComplete.hisrc");}});}});initSpeedTest();return $els;};})(jQuery);


/* App scripts */
function setMenu()
{
  var mq = window.matchMedia("(max-width: 50rem)");

  if (!mq.matches) {
    $('.page-wrap').removeClass('menu-open');
  }
}

$(document).ready(function () {

  var prevImg =
    '<svg width="30" height="48" class="prev-btn">' +
      '<image xlink:href="http://valleychurch.eu/wp-content/themes/valleychurch2/img/icons/icon-prev.svg" src="http://valleychurch.eu/wp-content/themes/valleychurch2/img/icons/icon-prev.png" width="30" height="48" class="prev-btn" />' +
    '</svg>';

  var nextImg =
    '<svg width="30" height="48" class="next-btn">' +
      '<image xlink:href="http://valleychurch.eu/wp-content/themes/valleychurch2/img/icons/icon-next.svg" src="http://valleychurch.eu/wp-content/themes/valleychurch2/img/icons/icon-next.png" width="30" height="48" class="next-btn" />' +
    '</svg>';

  $('.no-js').removeClass('no-js');

  $('.no-follow').click(function (e) {
    e.preventDefault();
  });

  $('.slides').responsiveSlides({
    speed: 500,
    timeout: 8000,
    auto: true,
    nav: true,
    pager: true,
    navContainer: '.slide-control',
    prevText: prevImg,
    nextText: nextImg
  });

  $(".container").fitVids();

  $('p > .fluid-width-video-wrapper').parent('p').addClass('aligncenter');

  $(".menu-toggle").on("click", function (e) {
    e.preventDefault();
    $('.page-wrap').toggleClass('menu-open');
  });

  $('.main-nav .menu-item').on({
    mouseenter: function() {
      $(this).find('.sub-menu').show();
    },
    mouseleave: function() {
      $(this).find('.sub-menu').hide();
    }
  });

  $('.hisrc img').hisrc();

});

$(window).on('load resize orientationchange', function () {
  debounce(setMenu());
});