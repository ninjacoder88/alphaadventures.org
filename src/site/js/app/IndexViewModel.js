requirejs(["jquery", "vue", "http"],
    function($, vue, http){
        "use strict";

        var data = {
            adventures: [],
            message: ""
        };

        var methods = {
            initialize: function(){
                http.loadAdventuresPreview()
                    .then(adventures => {
                        this.adventures = adventures;
                    }).catch(error => {
                        window.alert(error);
                    });
                
                http.loadSessionMessage()
                    .then(message => {
                        this.message = message;
                    })
            }
        };

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods,
            mounted: function(){
                this.initialize();
            }
        });
    })