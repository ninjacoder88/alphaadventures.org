requirejs(["vue", "http"],
    function(vue, http){
        "use strict";

        var data = {
            retrieval: "",
            emailAddress: "",
            message: ""
        };

        var methods = {
            reset: function(){
                this.message =  "";

                if(this.retrieval === ""){
                    this.message = "please choose which account option you need to retrieve";
                    return;
                }

                if(this.emailAddress.length < 6){
                    this.message = "the email address doesn't seem correct";
                    return;
                }

                var data = {retrieval: this.retrieval, emailAddress: this.emailAddress};

                http.resetAccount(data)
                    .then(() => {
                        this.message = "an email will be sent within 5 minutes. follow the instructions to access your account. you will be redirected to the home page";
                        setTimeout(() => {
                            window.location = "index.php";
                        }, 10000);
                    }).catch(error => {
                        this.message = error;
                    });
            }
        };

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods
        });
    });