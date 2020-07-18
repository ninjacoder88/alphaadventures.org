requirejs(["jquery", "vue", "bootstrap"],
    function($, vue){
        "use strict";

        var data = {

        };

        var methods = {
            login: function(){
                window.location = "home.php";
            }
        };

        var app = new vue({
            el: "#nav-bar",
            data: data,
            methods: methods
        })
    });