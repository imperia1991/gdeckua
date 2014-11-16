var auth = {
    login: function() {

    }
};

$(document).ready(function(){
    $('.signin').on('click', function(){
        $("#login").modal({
            'minHeight': '50%',
            'minWidth': '50%'
        });
    });

    auth.login();
});

