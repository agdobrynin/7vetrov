<?php
include('_header.php');
?>
<div class="row">
    <div class="col-md-6 panel-heading">
        <p>Дан текст с включенными в него тегами следующего вида:</p>
        <pre>[НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]</pre>
        <p class="text-muted">Вложенность тегов не допускается. Описания может и не быть. Обезателен закрвающий тег.</p>
    </div>
    <div class="col-md-6">
        <p>
            На выходе нужно получить 2 массива.
        </p>
        <ul>
            <dd>Первый:</dd>
            <li>Ключ - наименование тега</li>
            <li>Значение - данные</li>
        </ul>
        <ul>
            <dd>Второй:</dd>
            <li>Ключ - наименование тега</li>
            <li>Значение - описание</li>
        </ul>
    </div>
</div>
<?php if( isset($result1) == false && isset($result2) == false ){
    include 'task1_form.php';
}else{
    include 'task1_result.php';
} ?>
<?php
include('_footer.php');
