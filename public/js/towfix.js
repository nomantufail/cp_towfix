$(function() {
    $(".datetimepicker").datepicker();
    $('#ad').trigger('change');
} );

$(document).on("change", "#ad", function () {

    //$("#product_price").toggle();
    //$("#ad_form").toggle();
    //var check_poster = $("#ad").val();

    if($('#ad').is(':checked'))
    {
        console.log('yo');
        $("#product_price").hide();
        $("#ad_form").show();
    }
    else
    {
        $("#ad_form").hide();
        $("#product_price").show();
    }
});



$(document).ready(function(){
    $(".nav-btn").click(function(){
        $(".sidebar").toggle('slide');
    });
    $(".mobile-conv").click(function(){
        $(".users-list").toggle('slide');
    });
});
