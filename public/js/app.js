function EmptyModal() {
    $("#CalcModal .modal-title").text('');
    $("#CalcModal .modal-body .code-style").html('');
    $("#CalcModal .modal-body .alert-success").html('');
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
            $("#CalcModal .modal-title").text(data.name);
            /*
            $("#CalcModal .modal-body .code-style").html(data.body);
            $("#CalcModal .modal-body .alert-success").html(Calc.codes);
            */
            $("#CalcModal").modal('show');
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
            $("#CalcModal .modal-title").text('Ошибка');
            $("#CalcModal .modal-body .code-style").html(txt);
            $("#CalcModal").modal('show');
        },
        complete: function() {}
    });

});
