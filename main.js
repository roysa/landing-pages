$(document).ready(function(){
   
    // get all pages with their ids/urls
    var pages = {};
    $('.section').each(function(i,s){
        var id = $(s).attr('id');
        pages[id] = id;
    });
    
    // setup events for all section related links
    for (var id in pages) {
        // hook the event from section link
        $('a[href="/' + id + '"]').click(function(event){
            event.preventDefault();
            navigateTo($(this).attr('href').replace('/', ''));
        });
    }
    
    // determine current page and navigate to
    var currentPage = null;
    var uri = window.location.pathname.replace('/', '');
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
                window.history.pushState(null,null,'/' + page);
                currentPage = page;
            }
        });
    }
    
});