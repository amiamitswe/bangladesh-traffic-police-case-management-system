function startTime() {
    var date = new Date();
    var am_pm = "AM";
    var hour = date.getHours();
    if(hour>=12){
        am_pm = "PM";
    }
    if(hour>12){
        hour = hour - 12;
    }
    if(hour<10){
        hour = "0"+hour;
    }
    var minute = date.getMinutes();
    if (minute<10){
        minute = "0"+minute;
    }
    var sec = date.getSeconds();
    if(sec<10){
        sec = "0"+sec;
    }
    document.getElementById("txt").innerHTML =  hour+":"+minute+":"+sec+" "+am_pm;
}
setInterval(startTime,500);