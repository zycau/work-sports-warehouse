$(document).ready(function(){
    // 以下三个顺序绝对不能错，估计与js堆栈有关，如果改顺序会导致第一次点击menu时无法添加class
    // $(document).on('click',function(){
    //     $('#m-top-nav').removeClass('show');
    // });

    // $('#menu-icon,#m-top-nav').click(function(e){
    //     e.stopPropagation();
    // }); 
    
    // $('#menu-icon').on('click',function(){        
    //     $('#m-top-nav').addClass('show');        
    // }); 

    $('#menu-icon').on('click',function(){        
        $('#m-top-nav').toggleClass('show');        
    }); 

    $('body').removeClass('no-js');

})

// let menu = document.getElementById('menu-icon');
// let mNav = document.getElementById('m-top-nav');

// menu.addEventListener('click', showMNav);
// function showMNav(){
//     addClass(mNav, menu, showMNav,hideMNav);
// }
// function hideMNav(){
//     remClass(mNav,menu,hideMNav,showMNav);
// }


// function addClass(e1,e2,fun1,fun2){
//     e1.classList.add('show');
//     e2.removeEventListener('click', fun1);
//     e2.addEventListener('click',fun2);
// }
// function remClass(e1,e2,fun1,fun2){
//     e1.classList.remove('show');
//     e2.removeEventListener('click',fun1);
//     e2.addEventListener('click', fun2);
// }