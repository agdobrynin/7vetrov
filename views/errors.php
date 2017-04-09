<?php if($errors){?>
<div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        <h3>Ошибка!</h3>
        <?php if( is_array($errors) ){
          print "<ul>";
          foreach ($errors as $error) {
            ?>
            <li><?=$error?></li>
            <?php
          }
          print "</ul>";
        }?>
      </div>
    </div>
</div>
<?php }?>
