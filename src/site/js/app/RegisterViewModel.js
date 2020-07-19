requirejs(["jquery", "vue", "http"],
    function($, vue, http){
        "use strict";

        var data = {
            username: "",
            emailAddress: "",
            phoneNumber: "",
            password: "",
            error: "",
            message: ""
        };

        var methods = {
            register: function(){
                var data = {username: this.username, emailAddress: this.emailAddress, phoneNumber: this.phoneNumber, password: this.password};

                http.createUser(data)
                    .then((response) => {
                        this.message = "account succesfully created. check your email to complete registration";
                        this.username = "";
                        this.emailAddress = "";
                        this.phoneNumber = "";
                        this.password = "";
                        setTimeout(() => {
                            window.location = "index.php";
                        }, 10000);
                    }).catch(error => {
                        this.error = error;
                    })
            }
        };

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods
        });
    });