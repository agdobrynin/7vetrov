/**
 * Отправить на сервер AJAX запрос для генерации дерева
 * вешается на событие onSubmit формы
 * @param  DOM_element form Форма
 */
function TreeRest(form){
    var btn = $("button:first",form);
    $(btn).button('loading');
    $(".task3alert").hide();
    $.get(form.action, {levels: form.levels.value, childs: form.childs.value})
    .done(function( data ) {
        alert_success(data.title, data.body);
    })
    .fail(function( error ) {
        alert_danger(error.statusText, "Ошибка выполнения AJAX запроса, код ответа="+error.status);
    })
    .always(function() {
        $(btn).button('reset');
         $(".tree").empty();
    });
    return false;
}

/**
 * Загрузить с сервера дерево , AJAX запрос
 * вешается на событие onSubmit формы
 * @param  DOM_element form Форма
 */
function TreeShow(form){
    var btn = $("button:first",form);
    $(btn).button('loading');
    $(".task3alert").hide();
    $.get(form.action)
    .done(function( data ) {
        if( data !== null ){
            var $e = $(".tree");
            $e.html('<span class="loading"><i class="fa fa-spinner fa-spin "></i> Идет загрузка</span>');
            //Построение дерева
            $e.append(BuildTree($e, data));
            $("span.loading",$e).remove();
        }else{
            alert_danger("Получение дерева", "Данных в таблице дерева не найдено");
        }
    })
    .fail(function( error ) {
        alert_danger(error.statusText, "Ошибка выполнения AJAX запроса, код ответа="+error.status);
    })
    .always(function() {
        $(btn).button('reset');
    });
    return false;
}

/**
 * Функция построения дерева на рекурсии
 * @param  DOM_element   el   куда присоеденять дерево
 * @param  object   data массив
 * @param  DOM_element next родитель куда приедеденять потомков
 */
function BuildTree(el, data, next){
    var ul = document.createElement("ul");
    if( next == undefined ){
        $(el).append(ul);
    } else {
        $(next).append(ul);
    }
    for(a in data){
        var li = document.createElement("li");
        $(li).html(data[a].name + " (id= "+data[a].id+" / parent_id= "+data[a].parent_id+") ");
        ul.appendChild(li);
        BuildTree(el, data[a].child, ul);
    }
}

/**
 * Показ алерта об успешной операции
 * @param  string      title Заголовок
 * @param  string      body  текст сообщения
 */
function alert_success(title, body){
    var $e = $(".alert-success.task3alert");
    $("div .title", $e).text('');
    $("div p", $e).text('');
    $("div .title", $e).text(title);
    $("div p", $e).text(body);
    $e.slideDown();
}

/**
 * Показ алерта о ошибке в операции
 * @param  string      title Заголовок
 * @param  string      body  текст сообщения
 */
function alert_danger(title, body){
    var $e = $(".alert-danger.task3alert");
    $("div .title", $e).text('');
    $("div p", $e).text('');
    $("div .title", $e).text(title);
    $("div p", $e).text(body);
    $e.slideDown();
}

/**
 * Скрывает алерты
 */
$(".alert .close").click(function(){
    $(this).parent().slideUp();
});
