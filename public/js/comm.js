//文档加载完成是执行
$(function(){
 var $menuli=$("#Menu").children("ul").children("li");
 /*if($menuli.size()>0 && submenu_style!=2){
  $menuli.bind('mouseenter',function(){
   if($(this).children("ul").size()==0)
    {
     $(this).removeClass("hover"); //无下拉的菜单取消hover样式
    }
   $("#MenuItem"+Lanmu_Id).removeClass("menu_current");
  });
  $("#Menu").bind('mouseleave',function(){
    $("#MenuItem"+Lanmu_Id).addClass("menu_current");
  });
 }*/
 var $navmenu=$(".nav_menu");
 var $navmenu_a=$navmenu.children("ul").children("li").find("a");
 var $navmenu_a_current;
 if($navmenu_a.size()>0)
  {
    $navmenu_a_current=$navmenu.children("ul").children("li").find("a.current");
    $navmenu_a.bind('mouseenter',function(){
     //$navmenu_a_current.removeClass("current");
     $(this).parent().siblings().children("a").removeClass("current");
    });  
    $navmenu.bind('mouseleave',function(){
      $navmenu_a_current.addClass("current");
    }); 
  }

   //ajax加载轮播图
    $.post(
        "public/common/slider.php",
        {"slider":"true"},
        function(jsonstr){
            var ob = $.parseJSON(jsonstr);
            $('.bxslider .img1').attr('src',ob[0].pic_name);
            $('.bxslider .img2').attr('src',ob[1].pic_name);
            $('.bxslider .img3').attr('src',ob[2].pic_name);
            $('.bxslider .img4').attr('src',ob[3].pic_name);

        }
    );
    //轮播图控制
    $('.bxslider').bxSlider({
        mode:'horizontal', //默认的是水平
        captions: true,//自动控制
        auto: true,
        controls: true,//显示左右按钮
        pager: false,//是否在下方显示页码
        speed:1000,//图片滑动时间1s
        pause:3500,//图片停留时间4s
        autoHover:true,//当鼠标滑向滑动内容上时，是否暂停滑动,true停，false不停
        //easing: 'swing',
    });


});

function ShowSubMenu(id) //显示下拉
 {
   if(document.getElementById("Menu")==null){return;}
   var MenuItem=GetMenuItem();
   if(MenuItem.length<=1){return;}
   if(typeof(submenu_style)=="undefined")
    {
      submenu_style=1;  //1表示纵向下拉，2表示横向下拉,其他数值则关闭
    }
   switch(submenu_style)
    {
      case 1:
       document.write('<link rel="stylesheet" type="text/css" href="/e/css/dropmenu.css" />');
       addHover("Menu","li","hover");
      break;

     case 2:
       document.write('<link rel="stylesheet" type="text/css" href="/e/css/submenu.css" />');
       HorisontalSubMenu(id);
     break;
   }
 }

function addHover(id,tag,classname) //增加hover效果
 {
    var sfEls =document.getElementById(id).getElementsByTagName(tag);
    for (var i=0; i<sfEls.length;i++) 
        {
          sfEls[i].onmouseover=function() 
            {
             this.className+=" "+classname;
            }
          sfEls[i].onmouseout=function()
          {
            this.className=this.className.replace(new RegExp("( ?|^)"+classname+"\\b"),"");
          }
      }
 }

function HorisontalSubMenu(id)
 {
   var MenuItem=GetMenuItem();
   var classname="hover";
   if(MenuItem.length<1)
   {
     return;
   }
   for(i=0;i<MenuItem.length;i++)
    {
      MenuItem[i].className=MenuItem[i].className.replace(new RegExp("( ?|^)"+classname+"\\b"),"").replace(" menu_current","");
      if(MenuItem[i].id=="MenuItem"+id)
       {
         MenuItem[i].className+=" "+classname;
       }
      MenuItem[i].onmouseover=function(){HorisontalSubMenu(this.id.replace("MenuItem",""))};
    }
 }

function GetMenuItem()
 {
   var MenuItem;
   if(document.all)
    {
     var tagArr =document.getElementById("Menu").document.getElementsByTagName("li");
      var elements=[];
      for (var i=0; i<tagArr.length;i++)
       {
        var att=tagArr[i].getAttribute("name");if(att=="MenuItem"){elements[elements.length]=tagArr[i];}
       }
      MenuItem=elements;
    }
   else
    {
     MenuItem=document.getElementsByName("MenuItem");
    }
   return MenuItem;
 }

function nav(id) //一级导航鼠标展开
 {
    var thisobj=document.getElementById(id);
    if(thisobj==null){return;}
    var first_ul=thisobj.getElementsByTagName("ul")[0];
    if(first_ul!=null)
     {
       var dp=first_ul.style.display;
       if(dp=="none")
        {
          first_ul.style.display="block";
        }
      else
        {
          first_ul.style.display="none";
        }
     }
    if(this.url=="#")
     {
       return false;
     }
 }

function subnav(id,isroot) //导航鼠标点击展开
 {
    var thisobj=$("#"+id);
    if(thisobj.size()==0){return;}
    var first_ul=thisobj.children("ul");
    var first_span=thisobj.children("span");
    thisobj.siblings().children("ul").slideUp();
    thisobj.siblings().children("span.node").attr("class","node_close");
    if(first_ul.size()>0)
     {
       if(first_ul.is(":hidden"))
        {
          first_ul.slideDown();
        }
      else
        {
          first_ul.slideUp();
        }
      if(isroot){return;}
      if(first_span.attr("class")=="node")
       {
         first_span.attr("class","node_close");
       }
      else
       {
         first_span.attr("class","node");
       }
     }
 }

function shut_allsubnav(rootulid) //关闭所有导航
  {
   if(typeof(shut_subnav)=="undefined"){shut_subnav=1;}
   if(shut_subnav==0){return;}
   var rootul=document.getElementById(rootulid);
   if(rootul==null){return;}
   var child_ul=rootul.getElementsByTagName("ul");
   var child_span=rootul.getElementsByTagName("span");
   if(child_ul!=null)
   {
    for(i=0;i<child_ul.length;i++)
     {
       child_ul[i].style.display="none"
     }
   }
  if(child_span!=null)
   {
    for(i=0;i<child_span.length;i++)
     {
       if(child_span[i].className=="node")
        {
         child_span[i].className="node_close";
        }
     }
   }
  }

function expand_subnav(curentid,parentids) //根据当前sublamuid展开
  {
    if(curentid=="0"){return;}
    var c_sublanmu=document.getElementById(curentid);
    if(c_sublanmu!=null)
    {
    var child_ul=c_sublanmu.getElementsByTagName("ul");
    var first_span=c_sublanmu.getElementsByTagName("span")[0];
    if(child_ul[0]!=null)
     {
       child_ul[0].style.display="";
       if(first_span.className=="node_close" && parentids!="0")
        {
         first_span.className="node"
        }
     }
    var first_a=c_sublanmu.getElementsByTagName("a")[0];
    first_a.className=first_a.className+" current";
    }
    if(parentids=="0" || parentids==null){return}
    var Aparentids=parentids.split(",");
    var parentid;
    for(i=0;i<Aparentids.length;i++)
     {
       if(Aparentids[i]!="")
        {
          parentid="sl"+Aparentids[i];
          document.getElementById(parentid).style.display="";
          var child_ul=document.getElementById(parentid).getElementsByTagName("ul");
          var child_span=document.getElementById(parentid).getElementsByTagName("span");
          var child_a=document.getElementById(parentid).getElementsByTagName("a");
          if(child_ul.length>0){child_ul[0].style.display="";}
          if(child_a.length>0){child_a[0].className=child_a[0].className+" current";}
          if(child_span.length>0)
            {
              if(child_span[0].className=="node_close" && i>1)
               {
                child_span[0].className="node";
               }
            }
        }
     }

  }



