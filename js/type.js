$(function() {

    $(".subsplash").typed({
        strings: [
            "No one will guarantee you security.",
            "No one will guarantee you ^500 financial independence.",
            "No one will guarantee you ^500 the lifesyle you want.",
            "No one ^1000 except yourself.",
            "Know Your Banking.",
            "Know Yourself.",
            "Bank Like a Pro."
        ],
        typeSpeed: 5,
        backSpeed: 0,
        backDelay: 1000,
        callback: function() {
            $(".heading").fadeIn("slow");
        }
    });

});
