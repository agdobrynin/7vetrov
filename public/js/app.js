//AJAX запрос на герерацию дерева для task3
function TreeRest(form){
    var btn = $("button:first",form);
    $(btn).button('loading');
    $(".task3alert").hide();
    $.get(form.action)
    .done(function( data ) {
        alert_success(data.title, data.body);
    })
    .fail(function( error ) {
        alert_danger(error.statusText, "Ошибка выполнения AJAX запроса, код ответа="+error.status);
    })
    .always(function() {
        $(btn).button('reset');
    });
    return false;
}

function TreeShow(form){
    var btn = $("button:first",form);
    $(btn).button('loading');
    $(".task3alert").hide();
    $.get(form.action)
    .done(function( data ) {
        console.log( data.length );
    })
    .fail(function( error ) {
        alert_danger(error.statusText, "Ошибка выполнения AJAX запроса, код ответа="+error.status);
    })
    .always(function() {
        $(btn).button('reset');
    });
    return false;
}

function alert_success(title, body){
    var $e = $(".alert-success.task3alert");
    $("div h5", $e).text(title);
    $("div p", $e).text(body);
    $e.slideDown();
}

function alert_danger(title, body){
    var $e = $(".alert-danger.task3alert");
    $("div h5", $e).text('');
    $("div p", $e).text('');
    $("div h5", $e).text(title);
    $("div p", $e).text(body);
    $e.slideDown();
}

$(".alert .close").click(function(){
    $(this).parent().slideUp();
});
