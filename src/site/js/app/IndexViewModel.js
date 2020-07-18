requirejs(["jquery", "vue", "http"],
    function($, vue, http){
        "use strict";

        var data = {
            adventures: []
        };

        var methods = {
            initialize: function(){
                http.loadAdventures()
                    .then(adventures => {
                        this.adventures = adventures;
                    }).catch(error => {
                        window.alert(error);
                    });
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