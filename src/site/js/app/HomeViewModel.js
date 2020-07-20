requirejs(["vue", "http", "text!app/views/adventure.html"],
    function(vue, http, adventureTemplate){
        "use strict";

        var data =  {
            adventures: [],
            message: ""
        };

        var methods = {
            initialize: function(){
                window.Promise.all([http.loadAdventures(), http.loadRsvps(), http.loadSession()])
                    .then(resolvedPromises => {
                        var adventures = resolvedPromises[0];
                        var rsvps = resolvedPromises[1];

                        for(var a = 0; a < adventures.length; a++){
                            var matched = false;
                            var adventure = adventures[a];

                            var sd = new Date(adventure.StartDateTime);
                            var ed = new Date(adventure.EndDateTime);
                            adventure.StartDateTime = sd.toDateString() + " " + sd.toLocaleTimeString();
                            adventure.EndDateTime = ed.toDateString() + " " + ed.toLocaleTimeString();
                            
                            for(var r = 0; r < rsvps.length; r++){
                                var rsvp = rsvps[r];

                                if(adventure.AdventureId === rsvp.AdventureId){
                                    adventure.rsvpTypeId = parseInt(rsvp.RsvpTypeId);
                                    adventure.attendees = parseInt(rsvp.Attendees);
                                    adventure.notes = rsvp.Notes;
                                    adventure.rsvpId = parseInt(rsvp.RsvpId);
                                    adventure.notifySms = parseInt(rsvp.NotifyBySMS) === 1 ? true : false;
                                    adventure.notifyEmail = parseInt(rsvp.NotifyByEmail) === 1 ? true : false;
                                    matched = true;
                                }
                            }

                            if(matched === false){
                                adventure.rsvpTypeId = 0;
                                adventure.attendees = 1;
                                adventure.notes = "";
                                adventure.notifySms = 0;
                                adventure.notifyEmail = 0;
                            }
                        }

                        this.adventures = adventures;
                    }).catch(error => {
                        this.message = error;
                    });
            }
        };

        vue.component("adventure", {
            props: ["adventure"],
            data: function(){
                return {
                    message: ""
                }
            },
            methods: {
                respond: function(rsvpTypeId){
                    this.message = "";

                    if(this.adventure.rsvpId === null || this.adventure.rsvpId === undefined){
                        http.createRsvp({adventureId: this.adventure.AdventureId, rsvpTypeId: rsvpTypeId, attendees: this.adventure.attendees, notes: this.adventure.notes, notifySms: this.adventure.notifySms, notifyEmail: this.adventure.notifyEmail})
                            .then((rsvpId) => {
                                this.adventure.rsvpId = rsvpId;
                                this.adventure.rsvpTypeId = rsvpTypeId;
                            }).catch(error => {
                                this.message = error;
                            });
                    } else {
                        http.updateRsvp({adventureId: this.adventure.AdventureId, rsvpTypeId: rsvpTypeId, attendees: this.adventure.attendees, notes: this.adventure.notes, rsvpId: this.adventure.rsvpId, notifySms: this.adventure.notifySms, notifyEmail: this.adventure.notifyEmail})
                            .then(() => {
                                this.adventure.rsvpTypeId = rsvpTypeId;
                            }).catch(error => {
                                this.message = error;
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
                this.$nextTick(() => {
                    this.initialize();
                })
            }
        });
    });