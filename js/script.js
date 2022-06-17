
/*$(function(){
    $(".navbar a, footer a").on("click", function(event){
        
        event.preventDefault();
        var hash = this.hash;
        
        $('body,html').animate({scrollTop: $(hash).offset().top} , 400 , function(){window.location.hash=hash;})
        
    });
})
*/

/*
$(function(){
    $('.chart').easyPieChart({
        size: 160,
        barColor: "#004165",
        scaleLength: 0,
        lineWidth: 15,
        trackColor: "#00ebff",
        lineCap: "Circle",
        animate: 1500 
    })
})

*/


/*
Adinda: gevonden op internet: https://stackoverflow.com/questions/24428349/easy-pie-chart-does-not-loading-animation-using-waypoint-js
*/
 $(window).scroll( function(){

    /* Check the location of each desired element */
    $('.chart').each( function(){

        var bottom_of_object = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();

        /* If the object is completely visible in the window, fade it in */
        if( bottom_of_window > bottom_of_object ){
            $('.chart').easyPieChart({
              size: 160,
              barColor: "#004165",
              scaleLength: 0,
              lineWidth: 15,
              trackColor: "#00ebff",
              lineCap: "Circle",
              animate: 1500,
              onStep: function(from, to, percent) {
              $(this.el).find('.percent').text(Math.round(percent));
              }
            });
        }

      });
});



$(function(){
    $('[data-toggle="tooltip"]').tooltip();
})


/*


Mogelijks andere manieren dan waypoints om animatie te starten van zodra ze in de viewport komen...

https://blog.webdevsimplified.com/2022-01/intersection-observer/

https://stackoverflow.com/questions/27462306/css3-animate-elements-if-visible-in-viewport-page-scroll

https://www.youtube.com/watch?v=rPqghJhc5IA

*/