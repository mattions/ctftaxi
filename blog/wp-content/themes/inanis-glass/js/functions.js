/*Style Sheet Switcher version 1.1x April 13, 2008
Author: Dynamic Drive: http://www.dynamicdrive.com
Usage terms: http://www.dynamicdrive.com/notice.htm
Modified/Compressed for use in Inanis Wordpress Themes*/
var defaultstyle = ""; // Default Theme
var manual_or_random = "manual";
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('3 8="7 a";3 z="15";3 s="/";3 O="";2(J=="16"){3 F=b(z);2(F==t){4(17)}h{4(F)}}h 2(J=="l"){2(8=="18"){4("","l")}h 2(8=="19"){2(b("A")==t){c.m="A="+4("","l")+"; g=/"}h{4(b("A"))}}h 2(8.1b(/^[1-9]+ a/i)!=-1){2(b("C")==t||n(b("Q"))!=n(8)){r("C",4("","l"),n(8));r("Q",8,n(8))}}h{4(b("C"))}}k 4(j,u){3 i,6,f=[""];1d(i=0;(6=c.1f("1g")[i]);i++){2(6.q("1h").1i()=="1j 1k"&&6.q("j")){6.w=1l;f.1m(6);2(6.q("j")==j){6.w=I}}}2(D u!="E"){3 o=T.U(T.l()*f.W);f[o].w=I}G(D u!="E"&&f[o]!="")?f[o].q("j"):""}k b(K){3 y=M Z(K+"=[^;]+","i");2(c.m.L(y)){G c.m.L(y)[0].14("=")[1]}G t}k r(d,H,a,g,p,v){3 e=M 1a();3 1c=(D a!="E")?e.P(e.R()+n(a)):e.P(e.R()-5);c.m=d+"="+V(H)+(a?"; N="+e.X():"")+(g?"; g="+g:"")+(p?"; p="+p:"")+(v?"; v":"")}k 10(B,a){2(c.11){4(B);r(z,B,a,s,O)}}k 1n(d){2(b(d)){c.m=d+"="+((s)?"; g="+s:"")+";N = S/S/Y x:x:x";13(d+" - 12 1e")}}',62,86,'||if|var|setStylesheet||cacheobj||randomsetting||days|getCookie|document|name|expireDate|altsheets|path|else||title|function|random|cookie|parseInt|randomnumber|domain|getAttribute|setCookie|cookiepath|null|randomize|secure|disabled|00|re|cookiename|mysheet_s|styletitle|mysheet_r|typeof|undefined|selectedtitle|return|value|false|manual_or_random|Name|match|new|expires|cookiesecure|setDate|mysheet_r_days|getDate|01|Math|floor|escape|length|toGMTString|2000|RegExp|chooseStyle|getElementById|Cookie|alert|split|moot|manual|defaultstyle|eachtime|sessiononly|Date|search|expstring|for|Deleted|getElementsByTagName|link|rel|toLowerCase|alternate|stylesheet|true|push|deleteCookie'.split('|'),0,{}))

/* Clock Function
Author: Inanis (http://www.inanis.net)
Compressed by http://javascriptcompressor.com/ */
eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('e m(){j=2.7("");2.3("f").8(j);c=2.7("");2.3("h").8(c);d=2.7("");2.3("g").8(d)}e n(){6 a=o p();6 1=a.q();6 4=a.r();4=(4<s?"0":"")+4;6 i=(1<5)?"k":"l";1=(1>5)?1-5:1;1=(1===0)?5:1;2.3("f").b.9=1;2.3("h").b.9=4;2.3("g").b.9=i}',29,29,'|currentHours|document|getElementById|currentMinutes|12|var|createTextNode|appendChild|nodeValue|currentTime|firstChild|timeDisplay1|timeDisplay2|function|clockhr|clockpart|clockmin|timeOfDay|timeDisplay|AM|PM|init|updateClock|new|Date|getHours|getMinutes|10'.split('|'),0,{}))

/* Start Menu Functions
Author: Inanis (http://www.inanis.net) */

//Set some startup variables
var $sbox;
var OrbWasClicked = 0;
var MenuIsUp=0;
var l=0;
var w=0;
var lt=0;
var FadeCount=0;
var FadeSpeed=9;
var FadingIn=0;
var throb=0;
var throbcount=0;
var FlyOutOpen=0;
var FlyOutSum = 0;
var FlyOutWasClicked = 0;
var mhovIsUp = 0;
var mhovLastUp = 0;
var mhovering = 0;
var lhovering=0;
var timer = "";
var tid;

// Search Box
function SearchBoxFocus() {
  $sbox = document.getElementById('searchbox').value;
  if ($sbox == "Start Search" ){
    document.getElementById('searchbox').value = "";
    document.getElementById('searchbox').style.fontStyle = "normal";
  }
}
function SearchBoxBlur() {
  $sbox = document.getElementById('searchbox').value;
  if ($sbox == "" ){
    document.getElementById('searchbox').style.fontStyle = "italic";
    document.getElementById('searchbox').value = "Start Search";
  }
}

//Throb Cookie
function get_cookie ( cookie_name )
  {
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
  
    if ( results )
      return ( unescape ( results[2] ) );
    else
      return null;
  }

//Hide Opts Menu
function FadeOutMenu(){
  if (FadeCount==0){
    SMsHideAll();
    document.getElementById('StartMenu').style.visibility = "hidden";
  }
}

//When Orb is clikt
function OClkd() {
    OrbWasClicked = 1;
    if (MenuIsUp == 0)
    {
      document.getElementById('StartMenu').style.visibility = "visible";
      MenuIsUp = 1;
    }
    else
    {
      FadeOutMenu();
      MenuIsUp=0;
    }
}

//When Options is clikt
function SMClkd(){
  MenuIsUp=1;
  OrbWasClicked=1;
  
  if (FlyOutSum > 0)
    {
      FlyOutSum = FlyOutSum - FlyOutOpen;
      SMLower(FlyOutSum);
      FlyOutSum=0;
    }
}

//When Document is clikt
function BodyClicked() {
  if (OrbWasClicked != 1)
    {
      FadeOutMenu();
      MenuIsUp=0;
    }
  if (FlyOutWasClicked != 1 && FlyOutOpen > 0)
    {
      SMLower(4);
      SMLower(5);
      FlyOutOpen=0;
    }
  OrbWasClicked=0;
  FlyOutWasClicked=0;
  lowermhov();
}

//Throb balloon
function ThrobBaloon() {
  if (throbcount<20){
    if (throb==0)
      {
        document.getElementById('StartBaloon').style.color = "#F22";
        throb=1;
        setTimeout ( ThrobBaloon, 120 );
        throbcount++;
      }
    else {
        document.getElementById('StartBaloon').style.color = "#000";
        throb=0;
        setTimeout ( ThrobBaloon, 120 );
        throbcount++;
    }
  }
}

//Hide balloon
function HideThrob(){document.getElementById('StartBaloon').style.visibility = "hidden";}

//Init baloon
function StartThrob(){
  var throbbedyet = get_cookie("throb");
  if (throbbedyet!="yes") {
    document.getElementById('StartBaloon').style.visibility = "visible";
    ThrobBaloon();
    document.cookie = "throb=yes";
  }
  setTimeout (HideThrob, 6000);
}

//Hide/Show Secondary Submenus
function SMRaise(m) {
  element = "SMSub" + m;
  document.getElementById(element).style.visibility = "visible"; 
  if (m>0&&m<4) {
    document.getElementById(element).style.top = "35px";
  }
}
function SMLower(m){
  element = "SMSub" + m;
  if (m > 0){document.getElementById(element).style.visibility = "hidden";}
  
  if (m>0&&m<4) {
    document.getElementById(element).style.top = "1000px";
  }
}
// Hide/Show Flyout Menus
function SMFlot(n) {
  element = "SMSub" + n;
  if (document.getElementById(element).style.visibility == "visible")
    {
      document.getElementById(element).style.visibility = "hidden";
    }
  else
    { 
      document.getElementById(element).style.visibility = "visible";
      FlyOutWasClicked = 1;
      FlyOutSum = FlyOutOpen + n;
      FlyOutOpen = n;
    } 
}
function SMsHideAll() {SMLower(1);SMLower(2);SMLower(3);}
//Resize Sidebar to full document length, in pixels.
function sizeSidebar() {dh = document.getElementById("colwrap").scrollHeight;document.getElementById("sidebar").style.height=dh+"px";}
// Taskbar Menu Mouseovers
function mhov(id) {
  tid = "hov" + id;
  lhovering = 1;
  clearTimeout(timer);
  if (MenuIsUp == 0){
    if (mhovIsUp == 0){
      setTimeout("raisemhov()", 500);
    }
    else {
      document.getElementById(mhovLastUp).style.visibility = "hidden";
      raisemhov();
    }
  }
} 
function munhov(){lhovering = 0;timer = setTimeout ( "mhovkill()", 250 );}
function mhovkill(){
  if (mhovering == 0 && lhovering == 0) {
    lowermhov();
  }
}
function raisemhov(){
  // if still over menu.
  if (lhovering==1){
    document.getElementById(tid).style.visibility = "visible";
    mhovLastUp = tid;
    mhovIsUp = 1;
  }
}
function lowermhov(){   
  if (tid){document.getElementById(tid).style.visibility = "hidden";}
  mhovLastUp = 0;mhovIsUp = 0; 
}
function hovmhov(){mhovering = 1;}
function unhovmhov(){mhovering = 0;munhov();}
//Initfuncts on pg load
function InitPage() {SearchBoxBlur();updateClock();setInterval('updateClock()', 5000 );StartThrob();SMsHideAll();sizeSidebar();}