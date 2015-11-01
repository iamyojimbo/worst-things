$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

window.fbAsyncInit = function() {
  FB.init({
    appId      : CONFIG.facebook_app_id,
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.4' // use version 2.2
  });

   FB.getLoginStatus(function(response){
        if (response.status === 'connected') {
           getAndApplyUserDownvotes();
        }
    });
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function upsertUser(facebookUserId) {
    console.log("upserting user");
    return $.ajax({
        url:"/user",
        method: "PUT",
        data: {
            "facebookUserId" : facebookUserId
        },
        context: document.body,
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown)
        }
    });
}

function downvote(worstThingDOM) {
    setWorstThingAsBeingDownvoted(worstThingDOM);
    var worstThingId = $(worstThingDOM).data("id");
    return $.ajax({
        url:"/downvote",
        method: "POST",
        data: {
            "worstThingId" : worstThingId,
        },
        context: document.body,
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown)
        }
    });
}

function getUserDownvotes() {
    return $.ajax({
        url:"/user-downvotes",
        method: "GET",
        context: document.body,
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown)
        }
    });
}

function applyUserDownvotesToView(worstThingIds) {
    var userDownvotedWorstThings = $.grep($(".worst-thing"), function(worstThing){
        //$.inArray returns -1 if not in array and index if in array
        return $.inArray($(worstThing).data("id"), worstThingIds) >= 0;
    });
    $.each(userDownvotedWorstThings, function(){
        setWorstThingAsBeingDownvoted(this);
    });
}

function getAndApplyUserDownvotes() {
    getUserDownvotes().success(function(downvotes){
        var worstThingIds = $.map(downvotes, function(downvote){
            return downvote.worstThingId;
        });
        applyUserDownvotesToView(worstThingIds);
    });
}

function setWorstThingAsBeingDownvoted(worstThingDOM) {
    $(worstThingDOM).addClass("user-downvoted");
    $(worstThingDOM).find("button").prop('disabled', true);
    $(worstThingDOM).find(".downvote-count").html(
        parseInt($(worstThingDOM).find(".downvote-count").html())+1
    );
}

jQuery(document).ready(function(){
    $(".downvote button").click(function(){
        // Get this button's WorstThing element
        var worstThingDOM = $(this).closest(".worst-thing");
        FB.getLoginStatus(function(response){
            if (response.status === 'connected'){
                downvote(worstThingDOM);
            } else {
                FB.login(function(response){
                    upsertUser(response.authResponse.userID)
                        .success(function(response){
                            downvote(worstThingDOM).success(function(){
                                getAndApplyUserDownvotes();
                            });
                        });
                });
            }
        });
    });
});
