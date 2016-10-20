/**
 * Created by Mobeen on 10/19/2016.
 */
//$(document).ready(function(){
//
//    var check_poster = $("#ad").val();
//    if(ad == 1)
//    {
//        console.log('yo');
//        $("#ad_form").show();
//    }
//
//});




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
    console.log('asd');
});
