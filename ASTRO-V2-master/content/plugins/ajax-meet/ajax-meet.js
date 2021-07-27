$(document).ready(function () {
    $('.inscriptionButton').click(function (e) {
        e.preventDefault();

        meet_id = $('.id-getter').data('id');
        
        console.log(meet_id);

        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: ajaxurl,
                data: { action: 'do_ajax', meet_id: meet_id }
            }).done(
                function (response) {

                    $("#result").addClass("alert alert-success");
                    $("#result").css("visibility", "visible");
                    $("#logOutAlert").css("visibility", "hidden");

                    $("#login").css("visibility", "hidden");
                    $("#logOut").css("visibility", "visible");
                    
                }
            ).fail(
                function (response) {
                    console.log('Erreur: ' + response);
                }
            )
    });

    $('.logOutButton').click(function (e) {
        e.preventDefault();

        meet_id = $('.id-getter').data('id');
        
        console.log(meet_id);

        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: ajaxurl,
                data: { action: 'delete_registered', meet_id: meet_id }
            }).done(
                function (response) {

                    $("#logOutAlert").addClass("alert alert-warning");
                    $("#logOutAlert").css("visibility", "visible");
                    $("#result").css("visibility", "hidden");
            
                    $("#logOut").css("visibility", "hidden");
                    $("#login").css("visibility", "visible");
                    
                }
            ).fail(
                function (response) {
                    console.log('Erreur: ' + response);
                }
            )

        
    });

});