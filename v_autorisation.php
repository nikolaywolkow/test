<?php
if($_SESSION['vhod']==1)
{
echo 'Вы вошли как admin
<form method="POST">
    <button name="exit" value="1" type="submit" class="btn btn-primary">Выход</button>
</form>';
}
?>
<div class="form">
    <form class="form-horizontal" role="form" method="POST">

        <div class="form-group">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Логин" name="login">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Пароль" name="password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </div>
    </form>
    <?php echo "<h3>$message</h3>"; ?>
</div><!-- form  -->

</body>