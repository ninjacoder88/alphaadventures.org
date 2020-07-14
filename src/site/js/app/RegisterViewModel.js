requirejs(["jquery", "vue"],
    function($, vue){
        var data = {
            username: "",
            emailAddress: "",
            phoneNumber: "",
            password: ""
        };

        var methods = {
            register: function(){
                var data = {username: this.username, emailAddress: this.emailAddress, phoneNumber: this.phoneNumber, password: this.password};

                $.ajax({
                    method: "POST",
                    url: "/api/register/register.php",
                    data: data,
                    contentType: "application/json"
                }).done(function(response){
                    console.log(response);
                }).fail(function(a, b, c){
                    console.error({a: a, b: b, c:c});
                });
            }
        };

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods
        });
    });