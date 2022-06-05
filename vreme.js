
function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
}
function display_ct() {
    var today = new Date();
    var hours = today.getHours();
    var minutes = today.getMinutes();
    var secs = today.getSeconds();
    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (secs < 10) { secs = "0" + secs; }
    var time = hours + ":" + minutes + ":" + secs;
    var date = today.getDate() + "." + (today.getMonth() +1) +"." + today.getFullYear() +".";
    var dateTime = time + ' '+ date;
    document.getElementById('ct').innerHTML = dateTime;
    display_c();
}