$("a[href^='http'].url").each(function() {
    $(this).css({
        background: "url(http://g.etfv.co/' + this.href + ') left center no-repeat",
        "padding-left": "20px"
    });
});