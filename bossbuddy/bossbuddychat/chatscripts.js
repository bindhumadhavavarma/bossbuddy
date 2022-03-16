showContacts();

function showFriendRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showFriendRequests.php",
        data: {},
        success: function(html) {
            $("#requests_list").html(html).show();
        }
    });
    return false;
}
showFriendRequests();

function addfriend() {
    var inputusername = document.forms['friendRequestForm']['inputusername'].value;
    console.log(inputusername);
    if (inputusername == "") {
        document.getElementById("addformstatus").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Invalid Username.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        $.ajax({
            type: "POST",
            url: "http://localhost/bossbuddy/APIs/send_friend_request.php",
            data: {
                user2: inputusername
            },
            success: function(html) {
                $("#addformstatus").html(html).show();
            }
        });
    }
    return false;
}

function refreshRequests() {
    showFriendRequests();
}

function acceptRequest(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/acceptRequest.php",
        data: {
            sl: sl
        },
        success: function(html) {
            showFriendRequests();
            showContacts();
            $("#friendRequestStatus").html(html).show();
        }
    });
}

function showContacts() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showContacts.php",
        success: function(html) {
            showFriendRequests();
            $("#contactsList").html(html).show();
        }
    });
}

function refreshContacts() {
    showContacts();
}

function rejectRequest(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/rejectRequest.php",
        data: {
            sl: sl
        },
        success: function() {
            showFriendRequests();
        }
    });
}

function initiateChat(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/initiateChat.php",
        data: {
            sl: sl
        },
        success: function() {

            location.replace("http://localhost/bossbuddy/bossbuddychat/chat.php");

        }
    });
}



function closeChat() {
    location.replace("http://localhost/bossbuddy/bossbuddychat/");
}

function sendMsg() {
    console.log('sending msg');
    $.ajax({
        type: "POST",
        url: 'http://localhost/bossbuddy/APIs/sendMsg.php',
        data: { message: document.myForm.message.value },

    });
    document.myForm.message.value = "";
    updateMsgOnce();
    return false;
}

updateMsg();

function updateMsg() {
    window.console && console.log('requesting json');
    $.getJSON('chatlist.php', function(rowz) {
        window.console && console.log('json received');
        window.console && console.log('rowz');
        $('.messages').empty();
        for (var i = 0; i < rowz.length; i++) {
            entry = rowz[i];
            if (entry[1] == 0) {
                $('.messages').append("<div id='msgbody' style='margin:0 5px 5px auto;'>" + entry[0] + "<div>");
            } else {
                $('.messages').append("<div id='msgbody'>" + entry[0] + "</div>");
            }
        }
        updateScroll();
        setTimeout('updateMsg()', 3000);
    });
}

function updateMsgOnce() {
    window.console && console.log('requesting json');
    $.getJSON('chatlist.php', function(rowz) {
        window.console && console.log('json received');
        window.console && console.log('rowz');
        $('.messages').empty();
        for (var i = 0; i < rowz.length; i++) {
            entry = rowz[i];
            if (entry[1] == 0) {
                $('.messages').append("<div id='msgbody' style='margin:0 5px 0 auto;'>" + entry[0] + "<div>");
            } else {
                $('.messages').append("<div id='msgbody'>" + entry[0] + "</div>");
            }
        }
        updateScroll();
    });
}





var scrolled = false;
var lastScroll = 0;
var count = 0;
$("#chatscreen").on("scroll", function() {
    var nextScroll = $(this).scrollTop();

    if (nextScroll <= lastScroll) {
        scrolled = true;
    }
    lastScroll = nextScroll;

    console.log(nextScroll + 470, document.getElementById('chatscreen').scrollHeight)
    if ((nextScroll) + 470 == document.getElementById('chatscreen').scrollHeight) {
        scrolled = false;
    }
});

function updateScroll() {
    if (!scrolled) {
        var element = document.getElementById("chatscreen");
        element.scrollTop = element.scrollHeight;
    }
}

function deleteContact(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/deleteContact.php",
        data: {
            sl: sl
        },
        success: function() {
            showContacts();
        }
    });
}