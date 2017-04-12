function EmptyModal() {
    $("#Modal .modal-title").text('');
    $("#Modal .modal-body .code-style").html('');
    $("#Modal .modal-body .alert-success").html('');
}

$('.loadCalc').click(function(event) {
    event.preventDefault();

    $.ajax({
        type: "get",
        url: event.target.href,
        async: true,
        cache: false,
        beforeSend: function() {
            EmptyModal();
        },
        success: function(data) {
            $("#Modal .modal-title").text(data.title);
            $("#Modal .modal-body").html(data.body);
            $("#Modal").modal('show');
        },
        error: function(HttpRequest) {
            var txt;
            switch (HttpRequest.status) {
                case 0:
                    {
                        txt = "Сервер не отвечает";
                        break;
                    }
                case 404:
                    {
                        txt = "Запрошеный модуль <strong>" + event.target.href + "</strong> ненайден!";
                        break;
                    }
                default:
                    {
                        txt = "Ошибка выполнения AJAX запроса, код ответа=" + HttpRequest.status + ", строка ответа=" + HttpRequest.statusText;
                    }
            }
            $("#Modal .modal-title").text('Ошибка');
            $("#Modal .modal-body").html(txt);
            $("#Modal").modal('show');
        },
        complete: function() {}
    });

});
