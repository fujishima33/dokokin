(function($, window) {
    $(function() {
        var url = window.location;
        $('.nav a[href="'+url+'"]').addClass('active');
    
    });
})(jQuery, window);