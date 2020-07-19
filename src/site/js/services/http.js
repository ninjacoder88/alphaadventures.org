define(["jquery"],
    function(){
        "use strict";

        return {
            createUser: function(data){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "POST",
                        url: "/api/users/_create.php",
                        data: data,
                        dataType: "json"
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve();
                        } else {
                            reject(response.message);
                        }
                    }).fail(function(jqXHR, error, textStatus){
                        reject("failed to create a user");
                    });
                })
            },

            login: function(data){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "POST",
                        url: "/api/users/_login.php",
                        data: data,
                        dataType: "json"
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve();
                        } else {
                            reject(response.message);
                        }
                    }).fail(function(){
                        reject("login failed");
                    });
                });
            },

            loadAdventures: function(){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "GET",
                        url: "/api/adventures/_upcoming.php",
                        dataType: "json"
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve(response.adventures);
                        } else {
                            reject("an error occured while loading adventures");
                        }
                    }).fail(function(){
                        reject("failed to load adventures");
                    });
                });
            },

            loadAdventuresPreview: function(){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "GET",
                        url: "/api/adventures/_preview.php",
                        dataType: "json"
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve(response.adventures);
                        } else {
                            reject("an error occured while loading adventures");
                        }
                    }).fail(function(){
                        reject("failed to load adventures");
                    });
                });
            },

            loadRsvps: function(){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "GET",
                        url: "/api/rsvps/_user.php",
                        dataType: "json"
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve(response.rsvps);
                        } else {
                            reject("an error occurred while loading rsvps")
                        }
                    }).fail(function(){
                        reject("failed to load rsvps");
                    })
                });
            },

            createRsvp: function(data){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "POST",
                        url: "/api/rsvps/_create.php",
                        dataType: "json",
                        data: data
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve(response.rsvpId);
                        } else {
                            reject("an error occurred while creating the rsvp");
                        }
                    }).fail(function(){
                        reject("failed to create rsvp");
                    })
                });
            },

            updateRsvp: function(data){
                return new window.Promise((resolve, reject) => {
                    $.ajax({
                        method: "POST",
                        url: "/api/rsvps/_update.php",
                        dataType: "json",
                        data: data
                    }).done(function(response){
                        if(response.success === "true"){
                            resolve();
                        } else {
                            reject("an error occurred while updating the rsvp");
                        }
                    }).fail(function(){
                        reject("failed to update rsvp");
                    })
                });
            }
        };
    });