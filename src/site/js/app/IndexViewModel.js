requirejs(["jquery", "vue", "http"],
    function($, vue, http){
        "use strict";

        var data = {
            adventures: [],
            message: "",
        };

        var methods = {
            initialize: function(){
                window.Promise.all([http.loadAdventuresPreview(), http.loadSession()])
                    .then(resolvedPromises => {
                        var adventures = resolvedPromises[0];
                        var session = resolvedPromises[1];

                        this.adventures = adventures;
                        this.message = session.message;
                    }).catch(error => {
                        
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