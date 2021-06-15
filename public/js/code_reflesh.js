(function(){
    var reloading=function(dimg){
        var soldurl=dimg.src;
        var snewurl=soldurl+"?rnd"+Math.random();
        dimg.src=snewurl;
    };
    /*var reloading2=function(test){
        var soldpic=test;
        var snewpic=document.getElementById("math").innerHTML;
        test=snewpic;
    }*/
    var dlink=document.getElementById("reload-img");
    var dimg=document.getElementById("rand-img");
    //var test=document.getElementById("math").innerHTML;
    dlink.onclick=function(t){
        reloading(dimg);
        //reloading2(test);
        if(t){
            t.preventDefault();
            return false;
        };
    }
})();