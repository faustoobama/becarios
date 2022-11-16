'use strict';

window.onload = ()=>{
    let body = document.getElementsByTagName('body')[0],
    contador = 0;
    setInterval(() => {
        body.style.backgroundImage = "url('./extraFiles/img/becarios"+contador+".jpg')";
        contador++
        if(contador == 3)contador = 0;
    }, 6000);
}