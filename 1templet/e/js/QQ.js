// JavaScript Document
$(document).ready(function(){

   var qq="14837715,523108134,190452532";      //QQ号码在这里修改
   var Aqq=qq.split(',');
   var str='<div id="kf-xftb" class="kf-xftb"></div>';
   str+='<div id="kf-lf-lj" class="kf-lf-lj">';
   for(i=0;i<Aqq.length;i++)
     {
    str+='<a href="http://wpa.qq.com/msgrd?v=3&uin='+Aqq[i]+'&site=qq&Menu=yes" target="_blank"><span>'+Aqq[i]+'</span></a>'
     }
   str+='</div>'
  $("body").append(str);
  $("#kf-xftb").mouseenter(function(){
	 $(this).animate({left:"-53px"});
    $("#kf-lf-lj").animate({left:"0px"});
  });
  $("#kf-lf-lj").mouseleave(function(){
	  $("#kf-xftb").animate({left:"0px"});
    $("#kf-lf-lj").animate({left:"-191px"});
  }); 
});
