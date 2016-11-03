


//$(function() {
//    $(".datetimepicker").datepicker({ dateFormat: 'dd-mm-yy' , timeFormat:  "hh:mm:ss" });
//    $('#ad').trigger('change');
//} );
$(function() {
    $(".datetimepicker").datepicker({ format: 'Y/m/d A g:i',
        formatTime: 'A g:i' });
    $('#ad').trigger('change');
} );


$('#datetimepicker').datetimepicker({
    dateFormat: "yy-mm-dd",
    timeFormat:  "hh:mm:ss"
});

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
});
