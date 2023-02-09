(function($) {
    $("a[href^='http'].url").each(function() {
        $(this).css({
            background: "url(https://getfavicon.net/' + this.href + ') left center no-repeat",
            "padding-left": "20px"
        });
    });
}(jQuery));