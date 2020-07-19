requirejs(["vue", "http", "text!app/views/editadventure.html"],
    function(vue, http, editTemplate){
        "use strict";

        var data = {
            adventures: [],
            adventure: {AdventureId:0},
            message: ""
        };

        var methods = {
            loadAdventures: function(){
                http.loadAdventures()
                    .then(adventures => {
                        this.adventures = adventures;
                        this.adventure = adventures[0];
                    }).catch(error => {
                        this.message = error;
                    });
            },
            select: function(index){
                this.adventure = this.adventures[index];
            }
        };

        vue.component("edit-adventure", {
            props: ["adventure"],
            data: function(){
                return {
                    message: ""
                }
            },
            methods: {
                sendNotification: function(){
                    var data = {message: this.message, adventureId: this.adventure.AdventureId};

                    http.notifyAdventure(data)
                        .then(() => {

                        }).catch(error => {
                            alert(error);
                        })
                },
                updateAdventure: function(){
                    http.updateAdventure(this.adventure)
                        .then()
                        .catch(error => {
                            alert(error);
                        });
                }
            },
            template: editTemplate
        })

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods
        });
    });