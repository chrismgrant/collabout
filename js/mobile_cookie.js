/*
    The following javascript manages the css
    and cookies involved with mobile and desktop
    views.  To allow users to switch between views,
    format a link as follows:
    
    <a onClick="loadVIEW()" href="">VIEW</a>
    
    Where VIEW represents 'mobile' or 'desktop'.


*/


/*  Set of functions useful for managing lots of cookies */
function getCookie(c_name){
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i<ARRcookies.length;i++){
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name){return unescape(y);}}}
function setCookie(c_name,value,exdays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value +"; path=/;"}

/*Used to load appropriate views*/
function applycss(css) {    document.write('<link rel="stylesheet" type="text/css" href="css/'+css+'">');}
function setmobile(){
    setCookie('view','mobile',1); 
    applycss('mobile.css');
    document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=no" />');
}
function setdesktop(){
    setCookie('view','desktop',1); 
}

/*Main function used to apply views */
function checkCookie()
{
var view=getCookie("view");
if (view!=null && view!="")
  {
    /*Read the cookie and apply the correct view*/
    if      (view=='mobile'){setmobile();}
    else if (view=='desktop'){setdesktop();}
    else {setdesktop();}    /*default to desktop view*/
  }
else 
  {
    /*  No cookie has been found, so read the useragent
        and decide between mobile and desktop   */
    var ua = navigator.userAgent.toLowerCase();
        if (
            (ua.match(/iPhone/i)) || 
            (ua.match(/iPod/i)) ||
            (ua.search('android') > -1)||
            (ua.search('series60') > -1) ||
            (ua.search('symbian') > -1)||
            (ua.search('blackberry') > -1)||
            (ua.match(/blackberry/i))||
            (screen.width <= 400))
        {setmobile();}
        else{setdesktop();} 
  }
}

/* Used to reload the current page with another view */
function loadmobile(){setmobile();window.location.reload()}
function loaddesktop(){setdesktop();window.location.reload()}

checkCookie();