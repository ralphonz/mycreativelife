window.getComputedStyle||(window.getComputedStyle=function(t,e){return this.el=t,this.getPropertyValue=function(e){var n=/(\-([a-z]){1})/g;return"float"==e&&(e="styleFloat"),n.test(e)&&(e=e.replace(n,function(){return arguments[2].toUpperCase()})),t.currentStyle[e]?t.currentStyle[e]:null},this}),jQuery(document).ready(function($){var t=$(window).width();if(t>=768){$(".comment img[data-gravatar]").each(function(){$(this).attr("src",$(this).attr("data-gravatar"))});var e=document.querySelector(".masonry-container"),n;imagesLoaded(e,function(){n=new Masonry(e,{itemSelector:".masonry-entry",stamp:".archive-title"})})}}),function(t){function e(){i.setAttribute("content",u),s=!0}function n(){i.setAttribute("content",c),s=!1}function a(a){y=a.accelerationIncludingGravity,m=Math.abs(y.x),d=Math.abs(y.y),l=Math.abs(y.z),!t.orientation&&(m>7||(l>6&&8>d||8>l&&d>6)&&m>5)?s&&n():s||e()}if(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1){var r=t.document;if(r.querySelector){var i=r.querySelector("meta[name=viewport]"),o=i&&i.getAttribute("content"),c=o+",maximum-scale=1",u=o+",maximum-scale=10",s=!0,m,d,l,y;i&&(t.addEventListener("orientationchange",e,!1),t.addEventListener("devicemotion",a,!1))}}}(this);