requirejs(["jquery", "vue", "http", "bootstrap"],
    function($, vue, http){
        "use strict";

        var data = {
            loginusername: "",
            loginpassword: "",
            loginerror: ""
        };

        var methods = {
            login: function(){
                var data = {username: this.loginusername, password: this.loginpassword};

                http.login(data)
                    .then(response => {
                        window.location = "home.php";
                    }).catch(error => {
                        this.loginerror = error;
                    })
            }
        };

        var app = new vue({
            el: "#nav-bar",
            data: data,
            methods: methods
        })
    });