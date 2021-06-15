$(document).ready(function(){
    let leap_year = [31,29,31,30,31,30,31,31,30,31,30,31];
    let normal_year = [31,28,31,30,31,30,31,31,30,31,30,31];
    let month_name = ["January","Febrary","March","April","May","June","July","Auguest","September","October","November","December"];
    let month_num = [1,2,3,4,5,6,7,8,9,10,11,12];
    let current_date = new Date();
    let get_year = current_date.getFullYear();
    let get_month = current_date.getMonth();
    let get_date = current_date.getDate();

    function dayStart(month, year){
        let tmpDay = new Date(year, month, 1);
        return tmpDay.getDay();
    }
    function dayMonth(month, year){
        let tmp = year % 4;
        if(tmp===0){
            return leap_year[month];
        }
        else{
            return normal_year[month];
        }
    }
    function refreshDate(){
        let str = "";
        let totalDate = dayMonth(get_month, get_year);
        let firstDay = dayStart(get_month, get_year);
        if(firstDay===0){
            firstDay = 7;
        }
        let setclass;
        for(let i=1; i<firstDay; i++){
            str += "<li></li>";
        }
        for(let i=1; i<=totalDate; i++){
            if((i<get_date && get_year===current_date.getFullYear() && get_month===current_date.getMonth()) || get_year<current_date.getFullYear() || (get_year===current_date.getFullYear() && get_month<current_date.getMonth())){
                setclass = " class='btn lightgrey' disabled";
                if(i<10){
                    setclass = " class='btn lightgrey2' disabled";
                }
            }
            else if(i===get_date && get_month===current_date.getMonth() && get_year===current_date.getFullYear()){
                setclass = " class='btn green greenbox' value=" + get_year + "-" + month_num[get_month] + "-" + get_date + "";
                if(i<10){
                    setclass = " class='btn green2 greenbox' value=" + get_year + "-" + month_num[get_month] + "-" + get_date + "";
                }
            } 
            else{
                setclass = " class='btn darkgrey whitebox' value=" + get_year + "-" + month_num[get_month] + "-" + i + "";
                if(i<10){
                    setclass = " class='btn darkgrey2 whitebox' value=" + get_year + "-" + month_num[get_month] + "-" + i + "";
                }
            }
            str += '<li style="height:37px"><button'+setclass+' style="width:35px" onclick="getval(this)">'+i+'</button></li>';
            //str += "<li"+setclass+">"+i+"</li>";
        }
        $("#days").html(str);
        $("#calendar-title").html(month_name[get_month]);
        $("#calendar-year").html(get_year);
    }
    refreshDate();
    // $("#days ul li button").click(function(){
    //     $("#prev").click(function(e){return true;});
    //     $("#next").click(function(e){return true;});
    //     $("#go").val($(this).val());  
    // });
    $("#prev").click(function(e){
        //e.stopImmediatePropagation(); 
        $("#date").focus();
        get_month--;
        if(get_month<0){
            get_year--;
            get_month = 11;
        }
        refreshDate();
        e.preventDefault();
    });
    $("#next").click(function(e){
        $("#date").focus();
        get_month++;
        if(get_month>11){
            get_year++;
            get_month = 0;
        }
        refreshDate();
        e.preventDefault();
    });
    $("#calendar").addClass('noplay');
    // $("#date").click(function(){
    //     $(".calendar").removeClass('noplay');
    // });
    $('body').bind('click', function(event) {
        // IE支持 event.srcElement ， FF支持 event.target    
        let evt = event.srcElement ? event.srcElement : event.target;
        if(evt.id === "date"){
            $(".calendar").removeClass('noplay');
        }
        else if(evt.id === "calendar" || evt.id === "month" || evt.id === "body" || evt.id === "prev" || evt.id === "next" || evt.id === "calendar-title" || evt.id === "calendar-year"){
            return; // 如果是元素本身，则返bai
        }
        else if(evt.id === "one" || evt.id === "two" || evt.id === "three" || evt.id === "four" || evt.id === "five" || evt.id === "six" || evt.id === "seven"){
            return;
        }
        else {
            $('.calendar').addClass('noplay'); // 如不是则隐藏元素
        }
        // new 
        // if(evt.id === "touch"){
        //     $("#burger").attr('checked',true);
        // }
        // else if(evt.id === "show"){
        //     return;
        // }
        // else{
        //     $("#burger").attr('checked',false);
        // }
        //    
    });
});

/*let my_date = new Date();
    let my_year = my_date.getFullYear();
    let my_month = my_date.getMonth();
    let my_day = my_date.getDate();

    function dayStart(month, year) {
        let tmpDate = new Date(year, month, 1);
        return (tmpDate.getDay());
    }
    function daysMonth(month, year) {
        let tmp = year % 4;
        if (tmp == 0) {
            return (leap_year[month]);
        } else {
            return (normal_year[month]);
        }
    }
    function refreshDate(){
        let str = "";
        let totalDay = daysMonth(my_month, my_year); //獲取該月總天數
        let firstDay = dayStart(my_month, my_year); //獲取該月第一天是星期幾
        let myclass;
        for(let i=1; i<firstDay; i++){ 
            str += "<li></li>"; //為起始日之前的日期創建空白節點
        }
        for(let i=1; i<=totalDay; i++){
            if((i<my_day && my_year==my_date.getFullYear() && my_month==my_date.getMonth()) || my_year<my_date.getFullYear() || ( my_year==my_date.getFullYear() && my_month<my_date.getMonth())){ 
                myclass = " class='lightgrey'"; //當該日期在今天之前時，以淺灰色字體顯示
            }else if (i==my_day && my_year==my_date.getFullYear() && my_month==my_date.getMonth()){
                myclass = " class='green greenbox'"; //當天日期以綠色背景突出顯示
            }else{
                myclass = " class='darkgrey'"; //當該日期在今天後時，以深灰字體顯示
            }
            str += "<li"+myclass+">"+i+"</li>"; //創建日期節點
        }
        $("#days").html(str); //設置日期顯示
        $("#calendar-title").html(month_name[my_month]); //設置英文月份顯示
        $("#calendar-year").html(my_year); //設置年份顯示
    }*/
    
    //https://zhuanlan.zhihu.com/p/26401052
    //gggggg