$(function(){
    $('.bxslider').bxSlider({    
        mode: 'horizontal', //Type of transition between slides: horizontal', 'vertical', 'fade'
        speed: 800,        //Slide transition duration (in ms)
        pager: true,       //If true, a pager will be added
        auto: true,        //Slides will automatically transition
        pause: 3000,       //The amount of time (in ms) between each auto transition
        autoHover: true,   //Auto show will pause when mouse hovers over slider
        touchEnabled: false //fix the bug which makes the 'shop now' link unclickable.
        
    });


})