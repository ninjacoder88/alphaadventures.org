requirejs(["jquery", "vue", "http"],
    function($, vue, http){
        "use strict";

        var data = {
            username: "",
            emailAddress: "",
            phoneNumber: "",
            password: ""
        };

        var methods = {
            register: function(){
                var data = {username: this.username, emailAddress: this.emailAddress, phoneNumber: this.phoneNumber, password: this.password};

                http.createUser(data)
                    .then(() => {

                    }).catch(error => {
                        window.alert(error);
                    })
            }
        };

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods
        });
    });