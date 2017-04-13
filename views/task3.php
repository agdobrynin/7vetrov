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
        <h3>Действия</h3>
        <div class="alert alert-success task3alert" role="alert">
          <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
          <div><h4 class="title"></h4><p></p></div>
        </div>
        <div class="alert alert-danger task3alert" role="alert">
          <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
          <div><h4 class="title"></h4><p></p></div>
        </div>
        <form action="/task3/reset" method="get" onsubmit="return TreeRest(this)">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Сгенерировать дерево в БД</h4>
                        <div class="form-inline">
                            <div class="form-group">
                              <label>Уровней</label>
                              <select class="form-control" name="levels">
                                  <option value="2">2</option>
                                  <option value="4">4</option>
                                  <option value="6" selected >6</option>
                                  <option value="8">8</option>
                                  <option value="10">10</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Потомков в ветке до:</label>
                              <select class="form-control" name="childs">
                                  <option value="4">4</option>
                                  <option value="6">6</option>
                                  <option value="8">8</option>
                                  <option value="10">10</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-primary"
                                  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Идет генерация">
                                  Сгенерировать
                              </button>
                          </div>
                        </div>
                </div>
            </div>
        </form>
        <form action="/task3/tree" method="get" onsubmit="return TreeShow(this)">
            <h4>Отобразить дерево из БД</h4>
            <div class="form-group">
                <button type="submit" class="btn btn-success"
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Идет загрузка"
                >
                    Загрузить
                </button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Древо объектов/записей</div>
            <div class="panel-body tree">
                Не загружено
            </div>
        </div>
    </div>
</div>

<?php
include('_footer.php');
