let btnMenu=document.getElementById("btn-menu");
let menu=document.getElementById('menu');


window.addEventListener('load', () => {
    btnMenu.addEventListener('click',function(){
        menu.classList.toggle('mostrar');
    });
    
    
});
