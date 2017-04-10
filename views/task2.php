<?php
include('_header.php');
?>
<div class="row">
    <div class="col-md-6 panel-heading">
        <p>Дан текст в который включены ключи raz: dva: tri:</p>
        <p>Текст может располагаться как перед ключами так и после. На выходе нужно получить массив,
            где ключ это raz , dva , tri, а ДАННЫЕ - текст раполагающийся после ключа до следующего ключа или до конца текста, если не встретился ключ.
        <p>Очередность ключей может быть – произвльная. Если в тексте ключ встречается второй раз - в массиве он должен быть переписан.</p>
    </div>
    <div class="col-md-6">
        <h5>Результат обрабоки</h5>
        <?php if(isset($result1)){ ?>
            <div class="code-style"><?php print_r( $result1 ); ?></div>
        <?php }else{ ?>
            <p>Обработка не производилась</p>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="/task2/create" method="post">
            <fieldset>
                <div class="form-group">
                  <label for="">Текст для разбора:</label>
                  <textarea class="form-control" name="content" rows="10" placeholder="Введите ваш текст здесь" required><?= $subject?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Произвести разбор
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<?php
include('_footer.php');
