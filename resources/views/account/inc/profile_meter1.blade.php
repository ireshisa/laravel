
@push('styles')
<style>
.progress{
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
}
.progress:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid #fff;
    position: absolute;
    top: 0;
    left: 0;
}
.progress > span{
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}
.progress .progress-left{
    left: 0;
}
.progress .progress-bar{
    width: 100%;
    height: 100%;
    background: none;
    border-width: 12px;
    border-style: solid;
    position: absolute;
    top: 0;
}
.progress .progress-left .progress-bar{
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}
.progress .progress-right{
    right: 0;
}
.progress .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards;
}
.progress .progress-value{
    width: 90%;
    height: 90%;
    border-radius: 50%;
    background: #44484b;
    font-size: 24px;
    color: #fff;
    line-height: 135px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%;
}
.progress.blue .progress-bar{
    border-color: #049dff;
}
.progress.blue .progress-left .progress-bar{
    animation: loading-2 1.5s linear forwards 1.8s;
}
.progress.yellow .progress-bar{
    border-color: #fdba04;
}
.progress.yellow .progress-left .progress-bar{
    animation: loading-3 1s linear forwards 1.8s;
}
.progress.pink .progress-bar{
    border-color: #ed687c;
}
.progress.pink .progress-left .progress-bar{
    animation: loading-4 0.4s linear forwards 1.8s;
}
.progress.green .progress-bar{
    border-color: #1abc9c;
}
.progress.green .progress-left .progress-bar{
    animation: loading-5 1.2s linear forwards 1.8s;
}
@keyframes loading-1{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
}
@keyframes loading-2{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(144deg);
        transform: rotate(144deg);
    }
}
@keyframes loading-3{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
}
@keyframes loading-4{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(36deg);
        transform: rotate(36deg);
    }
}
@keyframes loading-5{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(126deg);
        transform: rotate(126deg);
    }
}
@media only screen and (max-width: 990px){
    .progress{ margin-bottom: 20px; }
}
.percircle.dark{background-color:#777}.percircle.dark .bar,.percircle.dark .fill{border-color:#c6ff00}.percircle.dark>span{color:#777}.percircle.dark:after{background-color:#555}.percircle.dark:hover>span{color:#c6ff00}.percircle.red .bar,.percircle.red .fill{border-color:#dd5454}.percircle.red:hover>span{color:#dd5454}.percircle.red.dark .bar,.percircle.red.dark .fill{border-color:#f84a4a}.percircle.red.dark:hover>span{color:#f84a4a}.percircle.blue .bar,.percircle.blue .fill{border-color:#092d5f}.percircle.blue:hover>span{color:#82cefa}.percircle.blue.dark .bar,.percircle.blue.dark .fill{border-color:#20cceb}.percircle.blue.dark:hover>span{color:#20cceb}.percircle.green .bar,.percircle.green .fill{border-color:#8dea7b}.percircle.green:hover>span{color:#8dea7b}.percircle.green.dark .bar,.percircle.green.dark .fill{border-color:#a9ff3a}.percircle.green.dark:hover>span{color:#a9ff3a}.percircle.orange .bar,.percircle.orange .fill{border-color:#e88239}.percircle.orange:hover>span{color:#e88239}.percircle.orange.dark .bar,.percircle.orange.dark .fill{border-color:#dc5b00}.percircle.orange.dark:hover>span{color:#dc5b00}.percircle.pink .bar,.percircle.pink .fill{border-color:#ff8ed0}.percircle.pink:hover>span{color:#ff8ed0}.percircle.pink.dark .bar,.percircle.pink.dark .fill{border-color:#ff58b9}.percircle.pink.dark:hover>span{color:#ff58b9}.percircle.purple .bar,.percircle.purple .fill{border-color:#aa7eff}.percircle.purple:hover>span{color:#aa7eff}.percircle.purple.dark .bar,.percircle.purple.dark .fill{border-color:#7a38f7}.percircle.purple.dark:hover>span{color:#7a38f7}.percircle.yellow .bar,.percircle.yellow .fill{border-color:#dcbd00}.percircle.yellow:hover>span{color:#dcbd00}.percircle.yellow.dark .bar,.percircle.yellow.dark .fill{border-color:#ffdb00}.percircle.yellow.dark:hover>span{color:#ffdb00}.percircle.gt50 .slice,.rect-auto{clip:rect(auto,auto,auto,auto)}.gt50 .fill,.percircle .bar,.pie{position:absolute;border:.08em solid #307bbb;width:.84em;height:.84em;clip:rect(0,.5em,1em,0);border-radius:50%;-webkit-transform:rotate(0deg);transform:rotate(0deg)}.bar{-webkit-backface-visibility:hidden;backface-visibility:hidden}.gt50 .bar:after,.gt50 .fill,.pie-fill{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.percircle{position:relative;font-size:120px;width:1em;height:1em;border-radius:50%;float:left;margin:0 .1em .1em 0;background-color:#ccc}.percircle *,.percircle :after,.percircle :before{box-sizing:content-box}.percircle.animate:after,.percircle.animate>span{-webkit-transition:-webkit-transform .2s ease-in-out;transition:transform .2s ease-in-out}.percircle.animate .bar{-webkit-transition:-webkit-transform .6s ease-in-out;transition:transform .6s ease-in-out}.percircle.center{float:none;margin:0 auto}.percircle.big{font-size:240px}.percircle.small{font-size:80px}.percircle>span{position:absolute;z-index:1;width:100%;top:50%;top:calc(50% - .1em);transform:translateY(-50%);height:1em;font-size:.2em;color:#ccc;display:block;text-align:center;white-space:nowrap}.perclock>span{font-size:.175em}.percircle:after{position:absolute;top:.08em;left:.08em;display:block;content:" ";border-radius:50%;background-color:#f5f5f5;width:.84em;height:.84em}.percircle .slice{position:absolute;width:1em;height:1em;clip:rect(0,1em,1em,.5em)}.percircle:hover{cursor:default}.percircle:hover>span{-webkit-transform:scale(1.3) translateY(-50%);transform:scale(1.3) translateY(-50%);color:#307bbb}.percircle:hover:after{-webkit-transform:scale(1.1);transform:scale(1.1)}

.percircle.big {
    font-size: 200px;
}



#progressbar {
  background-color: #e4e4ff;
  border-radius: 13px;
  /* (height of inner div) / 2 + padding */
  padding: 3px;
}

#progressbar>div {
  background-color: #5e6598;
  width: 40%;
  /* Adjust with JavaScript */
  height: 20px;
  border-radius: 10px;
  color:white;
}
</style>

@endpush

<hr>
   
   
       @php
   
    $user=auth()->user();
    if ($user->user_type_id == 2)
    {

        $values= profile_counter($user->photo ?? $user->avatar_url,$user);

    }
    else {

            $values= profile_counter($user->photo ?? $user->avatar_url,$user);

    }
 
    @endphp
   
   
   
   
   
   
   
   
   
     @if ($values!=100)
     
    <h3>{{__("Profile Meter")}}</h3>
    @php
   // dd($user);
    $user=auth()->user();
    if ($user->user_type_id == 2)
    {

        $values= profile_counter($user->photo ?? $user->avatar_url,$user);

    }
    else {
   $user->load('myCompanies');

            $values= profile_counter($user->photo ?? $user->avatar_url,$user);

    }
 //  dd($values);
    @endphp
    
    
    
 
    <div class="row">
    <div class="col-md-3 col-sm-4 text-center">
        
     <div id="progressbar" class="mobile-show">
       <div style=" width: {{$values}}% !important">{{$values}}%</div>
     </div>
        
        
    <!--    <div class="progress {{progress_status_color($values)}}">-->
    <!--        <span class="progress-left">-->
    <!--            <span class="progress-bar"></span>-->
    <!--        </span>-->
    <!--        <span class="progress-right">-->
    <!--            <span class="progress-bar"></span>-->
    <!--        </span>-->
       
    <!--        <div class="progress-value">{{$values}}%</div>-->
    <!--    </div>-->
    <!--</div>-->
    
    </div>
    </div>
    
    
    @endif
    
    
    
    
    
 @push('scripts')   
    <script>
	    !function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports&&"object"==typeof module?module.exports=t(require("jquery")):t(jQuery)}(function(t,e){"use strict";t.fn.percircle=function(e){var s={animate:!0};e||(e={}),t.extend(e,s);var o=3.6;return this.each(function(){t(this).hasClass("gt50")&&t(this).removeClass("gt50");var s=t(this),n="",d=function(t,e){s.on("mouseover",function(){t.children("span").css("color",e)}),s.on("mouseleave",function(){t.children("span").attr("style","")})};s.hasClass("percircle")||s.addClass("percircle"),"undefined"!=typeof s.attr("data-animate")&&(e.animate="true"==s.attr("data-animate")),e.animate&&s.addClass("animate"),"undefined"!=typeof s.attr("data-progressBarColor")?(e.progressBarColor=s.attr("data-progressBarColor"),n="style='border-color: "+e.progressBarColor+"'",d(t(this),e.progressBarColor)):"undefined"!=typeof e.progressBarColor&&(n="style='border-color: "+e.progressBarColor+"'",d(t(this),e.progressBarColor));var i=s.attr("data-percent")||e.percent||0,c=s.attr("data-perclock")||e.perclock||0,l=s.attr("data-perdown")||e.perdown||0;if(i){i>50&&s.addClass("gt50");var f=s.attr("data-text")||e.text||i+"%";s.html("<span>"+f+"</span>"),t('<div class="slice"><div class="bar" '+n+'></div><div class="fill" '+n+"></div></div>").appendTo(s),i>50&&t(".bar",s).css({"-webkit-transform":"rotate(180deg)","-moz-transform":"rotate(180deg)","-ms-transform":"rotate(180deg)","-o-transform":"rotate(180deg)",transform:"rotate(180deg)"});var m=o*i;setTimeout(function(){t(".bar",s).css({"-webkit-transform":"rotate("+m+"deg)","-moz-transform":"rotate("+m+"deg)","-ms-transform":"rotate("+m+"deg)","-o-transform":"rotate("+m+"deg)",transform:"rotate("+m+"deg)"})},0)}else c?(s.hasClass("perclock")||s.addClass("perclock"),setInterval(function(){var e=new Date,r=a(e.getHours())+":"+a(e.getMinutes())+":"+a(e.getSeconds());s.html("<span>"+r+"</span>"),t('<div class="slice"><div class="bar" '+n+'></div><div class="fill" '+n+"></div></div>").appendTo(s);var o=e.getSeconds();0===o&&s.removeClass("gt50"),o>30&&(s.addClass("gt50"),t(".bar",s).css({"-webkit-transform":"rotate(180deg);scale(1,3)","-moz-transform":"rotate(180deg);scale(1,3)","-ms-transform":"rotate(180deg);scale(1,3)","-o-transform":"rotate(180deg);scale(1,3)",transform:"rotate(180deg);scale(1,3)"}));var d=6*o;t(".bar",s).css({"-webkit-transform":"rotate("+d+"deg)","-moz-transform":"rotate("+d+"deg)","-ms-transform":"rotate("+d+"deg)","-o-transform":"rotate("+d+"deg)",transform:"rotate("+d+"deg)"})},1e3)):l&&r(s,e,n)})};var r=function(e,r,a){function s(){if(c-=1,c>30&&e.addClass("gt50"),c<30&&e.removeClass("gt50"),i(),c<=0)return n(),void e.html("<span>"+l+"</span>")}function o(){m=setInterval(s,1e3)}function n(){clearInterval(m)}function d(){n(),c=r.secs,i(),o()}function i(){e.html("<span>"+c+"</span>"),t('<div class="slice"><div class="bar" '+a+'></div><div class="fill" '+a+"></div></div>").appendTo(e);var r=6*c;t(".bar",e).css({"-webkit-transform":"rotate("+r+"deg)","-moz-transform":"rotate("+r+"deg)","-ms-transform":"rotate("+r+"deg)","-o-transform":"rotate("+r+"deg)",transform:"rotate("+r+"deg)"})}var c=e.attr("data-secs")||r.secs,l=e.attr("data-timeUpText")||r.timeUpText,f=e[0].hasAttribute("data-reset")||r.reset;l.length>8&&(l="the end");var m;f&&e.on("click",d),o()},a=function(t){return t<10?"0"+t:t}});

  

	</script>
@endpush