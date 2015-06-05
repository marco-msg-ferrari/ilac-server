/**
 *
 * Created by marco on 5/06/15.
 */

$( "#form_type").parent().hide();

$( "#form_carbohydrates").change(function() {
    $("suggest > span").html('...');
    $.ajax({
        url: Routing.generate('ilac_main_calc_bolus', { testID: 1, carb: 1 }),
        cache: false,
        dataType: "json"
    }).done(function( data ) {
        $("suggest > span").html(data.suggest);
    });
});
$( "<suggest>Suggested value: <span></span></suggest>" ).insertAfter( $("#form_carbohydrates").parent() );

function changeToSlow() {
    $( "#form_carbohydrates").parent().hide();
    $( "#lastTest").hide();
    $( "#form_type").val('slow');
    $( "#slowSel").addClass('active');
    $( "#fastSel").removeClass('active');
    $("suggest").hide();
}

function changeToFast() {
    $( "#form_carbohydrates").parent().show();
    $( "#lastTest").show();
    $( "#form_type").val('fast');
    $( "#fastSel").addClass('active');
    $( "#slowSel").removeClass('active');
    $("suggest").show();
}

changeToSlow();
