requirejs(["jquery", "vue", "bootstrap"],
    function($, vue){
        var data = {

        };

        var methods = {
            login: function(){
                alert("login");
            }
        };

        var app = new vue({
            el: "#nav-bar",
            data: data,
            methods: methods
        })
    });