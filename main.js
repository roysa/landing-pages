$(document).ready(function(){
   
   var baseUrl = $('body').attr('data-base-url');
   
    // get all pages with their ids/urls
    var pages = {};
    $('.section').each(function(i,s){
        var id = $(s).attr('id');
        pages[id] = id;
    });
    
    // setup events for all section related links
    for (var id in pages) {
        // hook the event from section link
        $('a[href="' + baseUrl + id + '"]').click(function(event){
            event.preventDefault();
            navigateTo($(this).attr('href').replace(baseUrl, ''));
        });
    }
    
    // determine current page and navigate to
    var currentPage = null;
    var uri = window.location.pathname.replace(baseUrl, '');
    for (var id in pages) {
        if (uri == id) {
            currentPage = id;
            break;
        }
    }
    navigateTo(currentPage);
    
    /**
     * this will scroll the page and add history state
     */
    function navigateTo(page)
    {
        
        var pos = $('#' + page).offset().top; // section offset
        pos -= $('.page').offset().top; // offset for menu
        console.log('Navigate to ' + page);
        
        // scroll the page
        $('html,body').animate({
            scrollTop: pos
        }, 500, 'swing', function(){
            // when animation hinished, change URL
            if (currentPage != page) {
                window.history.pushState(null,null, baseUrl + page);
                currentPage = page;
            }
        });
    }
    
});