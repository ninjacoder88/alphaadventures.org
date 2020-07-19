requirejs(["vue", "http"],
    function(vue, http){
        "use strict";

        var data = {
            feedback: "",
            message: ""
        };

        var methods = {
            sendFeedback: function(){
                this.message = "";
                var data = {feedback: this.feedback};

                if(this.feedback.length < 10){
                    this.message = "your feedback seems a little short. maybe add some more details";
                    return;
                }
                if(this.feedback.length > 500){
                    this.message = "please limit your feedback to 500 characters";
                    return;
                }

                http.sendFeedback(data)
                    .then(() => {
                        this.feedback = "";
                        alert("your feedback has been sent");
                    }).catch(error => {
                        this.message = error;
                    });
            }
        };

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods
        })
    });