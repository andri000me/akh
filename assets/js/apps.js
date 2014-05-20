$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        console.log($(this).width())
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    });
});

// Only use extJS
var datetime = new Date();
var INDEX_URL = 'http://127.0.0.1:4444/JohnDoe/index.php/';

function loading()
{
    $('.loading').ajaxStart(function(){
        $(this).fadeIn(100);
    }).ajaxStop(function(){
        $(this).fadeOut(1500);
    });
        
}




