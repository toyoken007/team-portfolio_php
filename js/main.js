window.onload = function(){
    let head = document.getElementsByClassName('header')[0].offsetHeight;
    let hp_main = document.getElementsByTagName('main')[0];

   
    // if( location.pathname === "/reserve/") {
        hp_main.style.marginTop = head + 'px';
    // }
}