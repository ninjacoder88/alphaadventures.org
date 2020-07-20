requirejs(["vue", "http", "text!app/views/edit-user.html", "text!app/views/edit-adventure.html", ],
    function(vue, http, userTemplate, adventureTemplate){
        "use strict";

        vue.component("edit-user", {
            props: ["user"],
            data: function(){
                return {
                    message: ""
                };
            },
            methods: {
                saveUser: function(){
                    alert("save");
                },
                deleteUser: function(){
                    alert("delete");
                }
            },
            template: userTemplate
        });

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
                        .then((errors) => {
                            this.message = "";
                            console.error(errors);
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
            template: adventureTemplate
        });

        var app = new vue({
            el: "#app",
            data: {
                adventures: [],
                adventure: {AdventureId:0},
                message: "",
                users: []
            },
            methods: {
                loadAdventures: function(){
                    http.loadAdventures()
                        .then(adventures => {
                            this.adventures = adventures;
                            this.adventure = adventures[0];
                        }).catch(error => {
                            this.message = error;
                        });
                },
                loadUsers: function(){
                    http.loadUsers()
                        .then(users => {
                            this.users = users;
                        }).catch(error => {
                            this.message = error;
                        });
                },
                select: function(index){
                    this.adventure = this.adventures[index];
                }
            }
        });
    });