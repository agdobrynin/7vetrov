<?php
include('_header.php');
?>
<div class="row">
    <div class="col-md-6 panel-heading">
        <p>Дана таблица в базе MySQL с полями:</p>
        <ul>
            <li>
                id  - ключ
            </li>
            <li>
                name  имя
            </li>
            <li>
                parent_id ссылка на id родителя
            </li>
        </ul>
        <p> Данную таблицу нужно заполнить рандомными значениями,
            но так что бы получилось дерево с несколькими (от 0 до 5) уровнями вложенности.</p>
        <p>
            Реализовать алгоритм выводящий это дерево.
        </p>

    </div>
    <div class="col-md-6">
        <h5>Действия</h5>
        <div class="alert alert-success task3alert" role="alert">
          <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
          <div><h5></h5><p></p></div>
        </div>
        <div class="alert alert-danger task3alert" role="alert">
          <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
          <div><h5></h5><p></p></div>
        </div>
        <form action="/task3/reset" method="get" onsubmit="return TreeRest(this)">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Идет генерация">
                    Сгенерировать дерево в БД
                </button>
            </div>
        </form>
        <form action="/task3/tree" method="get" onsubmit="return TreeShow(this)">
            <div class="form-group">
                <button type="submit" class="btn btn-success"
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Идет генерация"
                >
                    Отобразить дерево
                </button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12 tree">

    </div>
</div>

<?php
include('_footer.php');
