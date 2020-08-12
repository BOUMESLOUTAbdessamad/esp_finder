Conversations = {
    conv : null,
    Messages: {
        onquery: false,
        xhr: null,
        templates: {
            "in" : null,
            "out" : null
        },
        resume: function(conv) {
            Conversations.conv = conv;   
            var ref = firebase.database().ref('conversations/'+conv+'/messages/');
            var messages = [];
            ref.orderByChild('created').limitToLast(10).once('value').then(function(dataSnapshot) {
                
                dataSnapshot.forEach(function(object) {
                    var message = object.val();
                    message.id = object.key;
                    message.direction = (message.user.id == USER ? "out" : "in");
                    message.u1_fname = message.user.name;
                    message.ago = message.created;

                    //file
                    if(message.attachement) {
                        message.file_name = message.attachement.name;
                        message.file_path = message.attachement.path;
                    }
                    //
                    messages.push(message);
                });

                $.get(BASE_URL + "templates/messages.html",function(html) {
                    var html = $('<div>').append(html);
                    Conversations.Messages.templates.in = Template7.compile($(html).find('#msgIn')[0].outerHTML);
                    Conversations.Messages.templates.out = Template7.compile($(html).find('#msgOut')[0].outerHTML);
                    $.each(messages,function(i,msg) {
                        if(msg.direction == "out") {
                            $('#messagesHolder').append(Conversations.Messages.templates.out(msg));
                        } else {
                            $('#messagesHolder').append(Conversations.Messages.templates.in(msg));
                        }
                    });
                    if($("#messagesHolder").children('div:last').length) {
                        $('#messagesHolder').parent().animate({
                            scrollTop: $("#messagesHolder").parent().scrollTop() + $("#messagesHolder").children('div:last').offset().top
                        }, 1200);
                    }
    
                    setTimeout(function() {
                        Conversations.Messages.refresh(Conversations.conv);
                    }, 400);
                });
            }); 

            /*$.post(BASE_URL + "messages/get_conversation/" + Conversations.conv, function(r) {
                var messages = r.data;
                //bring the templates
                $.get(BASE_URL + "templates/messages.html",function(html) {
                    var html = $('<div>').append(html);
                    Conversations.Messages.templates.in = Template7.compile($(html).find('#msgIn')[0].outerHTML);
                    Conversations.Messages.templates.out = Template7.compile($(html).find('#msgOut')[0].outerHTML);
                    $.each(messages,function(i,msg) {
                        if(msg.direction == "out") {
                            $('#messagesHolder').append(Conversations.Messages.templates.out(msg));
                        } else {
                            $('#messagesHolder').append(Conversations.Messages.templates.in(msg));
                        }
                    });

                    if($("#messagesHolder").children('div:last').length) {
                        $('#messagesHolder').parent().animate({
                            scrollTop: $("#messagesHolder").parent().scrollTop() + $("#messagesHolder").children('div:last').offset().top
                        }, 1200);
                    }
                    setTimeout(function() {
                        Conversations.Messages.refresh(Conversations.conv);
                    }, 400);
                });
            })*/
        },
        refresh: function(conv) {
            var ref = firebase.database().ref('conversations/'+conv+'/messages/');
            ref.limitToLast(10).on('child_added',function(data) {
                if(!($('[data-id="'+data.key+'"]').length > 0)) {
                    var message = data.val();
                    message.id = data.key;
                    message.direction = (message.user.id == USER ? "out" : "in");
                    message.u1_fname = message.user.name;
                    message.ago = message.created;
                    //file
                    if(message.attachement) {
                        message.file_name = message.attachement.name;
                        message.file_path = message.attachement.path;
                    }
                    //
                    if(message.direction == "out") {
                        $('#messagesHolder').append(Conversations.Messages.templates.out(message));
                    } else {
                        $('#messagesHolder').append(Conversations.Messages.templates.in(message));
                    }
                    /*if( $("#messagesHolder").find('li:last').length) {
                        $('#messagesHolder').parent().animate({
                            scrollTop: $("#messagesHolder").find('li:last').offset().top
                        }, 1200);
                    }*/
                }
            });
            /*if (Conversations.Messages.onquery == false) {
                Conversations.Messages.onquery = true;
                Conversations.Messages.xhr = $.post(BASE_URL + "messages/refresh/" + conv + "/" + ($('#messagesHolder').children('div:last').attr('data-id') ? $('#messagesHolder').children('div:last').attr('data-id') : ""), function(r) {
                    if (r.data && r.data.length > 0) {
                        $.each(r.data, function (i, msg) {
                            if (!$("[data-id='" + msg.id + "']").length) {
                                if (msg.direction == "out") {
                                    $('#messagesHolder').append(Conversations.Messages.templates.out(msg));
                                } else {
                                    $('#messagesHolder').append(Conversations.Messages.templates.in(msg));
                                }
                            }
                        });

                        $('#messagesHolder').parent().animate({
                            scrollTop: $("#messagesHolder").parent().scrollTop() + $("#messagesHolder").children('div:last').offset().top
                        }, 1200);
                    }
                    Conversations.Messages.onquery = false;
                    setTimeout(function() {
                        Conversations.Messages.refresh(conv);
                    }, 400);
                })
            } else {
                setTimeout(function() {
                    Conversations.Messages.refresh(conv);
                }, 400);
            }*/
        },

        more: function(conv) {
            //challenging haan 
            var ref = firebase.database().ref('conversations/'+conv+'/messages/');
            ref.orderByChild('created').once("value").then(function(dataSnapshot) {
                var messages = [];
                dataSnapshot.forEach(function(data) { 
                    var message = data.val();
                    message.id = data.key;
                    message.direction = (message.user.id == USER ? "out" : "in");
                    message.u1_fname = message.user.name;
                    message.ago = message.created;
                    //file
                    if(message.attachement) {
                        message.file_name = message.attachement.name;
                        message.file_path = message.attachement.path;
                    }
                    messages.push(message);
                });

                //html insert
                messages.reverse();
                messages.forEach(function(message) {
                    if(!($('[data-id="'+message.id+'"]').length > 0)) {
                        if(message.direction == "out") {
                            $('#messagesHolder').prepend(Conversations.Messages.templates.out(message));
                        } else {
                            $('#messagesHolder').prepend(Conversations.Messages.templates.in(message));
                        }
                    }
                })
              });
            /*$.post(BASE_URL + "messages/more/" + conv + "/" + $('#messagesHolder').children('div:first').attr('data-id'), function(r) {
                if (r.data && r.data.length > 0) {
                    $.each(r.data,function(i,msg) {
                        if(msg.direction == "out") {
                            $('#messagesHolder').prepend(Conversations.Messages.templates.out(msg));
                        } else {
                            $('#messagesHolder').prepend(Conversations.Messages.templates.in(msg));
                        }
                    });
                }
            })*/
        },
        send: function(event) {
            var data = $(event.target).closest('#msgForm').find('*').serializeObject();
            $(event.target).closest('#msgForm').find('#btn-input').val('');
            $.post(BASE_URL + "messages/send/"+ data.conversation, data, function(r) {
                $('#msgFileDisplay').click();
                //r.data.direction = "out";
                //$('#messagesHolder').append(Conversations.Messages.templates.out(r.data));
                $('#messagesHolder').parent().animate({
                    scrollTop: $("#messagesHolder").parent().scrollTop() + $("#messagesHolder").children('div:last').offset().top
                }, 1200);
            })
        }

    }
}