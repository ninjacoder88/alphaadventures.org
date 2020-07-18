requirejs(["jquery", "vue", "http", "text!app/views/adventure.html"],
    function($, vue, http, adventureTemplate){
        "use strict";

        var data =  {
            adventures: []
        };

        var methods = {
            initialize: function(){
                window.Promise.all([http.loadAdventures(), http.loadRsvps()])
                    .then(resolvedPromises => {
                        var adventures = resolvedPromises[0];
                        var rsvps = resolvedPromises[1];

                        adventures.forEach(adventure => {
                            for(var i = 0; i < rsvps.length; i++){
                                var rsvp = rsvps[i];

                                if(adventure.AdventureId === rsvp.AdventureId){
                                    adventure.rsvpTypeId = rsvp.RsvpTypeId;
                                    adventure.attendees = rsvp.Attendees;
                                    adventure.notes = rsvp.Notes;
                                    adventure.rsvpId = rsvp.RsvpId;
                                } else {
                                    adventure.rsvpTypeId = 0;
                                    adventure.attendees = 1;
                                    adventure.notes = "";
                                }
                            }
                        });

                        this.adventures = adventures;
                        console.log(rsvps);
                    }).catch(error => {
                        window.alert(error);
                    });
            }
        };

        vue.component("adventure", {
            props: ["adventure"],
            data: function(){
            },
            methods: {
                respond: function(rsvpTypeId){
                    if(this.adventure.responseId === null || this.adventure.responseId === undefined){
                        http.createRsvp({adventureId: this.adventure.AdventureId, rsvpTypeId: rsvpTypeId, attendees: this.adventure.attendees, notes: this.adventure.notes})
                            .then(() => {
                                this.adventure.rsvpTypeId = rsvpTypeId;
                            }).catch(error => {
                                window.alert(error);
                            });
                    } else {
                        http.updateResponse({adventureId: this.adventure.AdventureId, rsvpTypeId: rsvpTypeId, attendees: this.adventure.attendees, notes: this.adventure.notes, responseId: this.adventure.responseId})
                            .then(() => {
                                this.adventure.rsvpTypeId = rsvpTypeId;
                            }).catch(error => {
                                window.alert(error);
                            });
                    }
                }
            },
            template: adventureTemplate
        });

        var app = new vue({
            el: "#app",
            data: data,
            methods: methods,
            mounted: function(){
                this.initialize();
            }
        });
    });