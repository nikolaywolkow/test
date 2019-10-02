<?php
session_start();
include 'v_top.php';
include 'model.php';

if($_SESSION['vhod']==1)$autor='Admin';

$model=new bd_work();

if(isset($_POST['textZ']) && isset($_POST['email']))
{
    $text=trim($_POST['textZ']);
    $email=trim($_POST['email']);

    if(strlen($text)>10)
    {
        if($_SESSION['vhod']==1)$autor='Admin';

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $rezult=$model->writeTask($text,$email,$autor);

            if($rezult)$message="Ваша задача добавленна.";
            else $message="ошибка записи";

        }
        else $message="Неправельно указан email.";
    }
    else $message="Задача должна быть, длиннее 10 символов.";
}

?>

<div class="container">
    <a class="btn btn-outline-primary" href="?add=1">Добавить задачу</a>

    <?php



    if(isset($_GET['add']))
    {
        echo '
        <form method="POST">
            <div class="form-group">
                <label for="inputEmail">Введите текс задачи:</label>
                <input required class="form-control" name="textZ" placeholder="Задача" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="inputPassword">Введите email:</label>
                <input required type="email" class="form-control" name="email" placeholder="email">
            </div>

            <button class="btn btn-primary" type="submit" >Отправить</button>
        </form>';
    }


    if(isset($_GET['gotovo']) && $autor=='Admin')$model->status_gotovo($_GET['gotovo']);
    if(isset($_POST['text_edit']) && $autor=='Admin')
    {
        $text_task=$_POST['text_edit'];
        $id=$_POST['id_edit'];
        $message=$model->edit_text_task($id,$text_task);
    }
    if(isset($_GET['sort']))$sort=$_GET['sort'];
    if(isset($_GET['DESC']))$DESC='DESC';
    if(isset($_POST['page']))$page=$_POST['page']-1;
    else $page=0;
    if(isset($_GET['edit']) && $autor=='Admin')
    {
        $id=$_GET['edit'];
        $text_task=$model->get_text_task($id);
        echo "
        <form method='POST'>
            <div class='form-group'>
                <label for='inputEmail'>Редактируйте текст задачи:</label>
                <input required class='form-control' name='text_edit' placeholder='Задача' autocomplete='off' value='$text_task'>
            </div>

            <button class='btn btn-primary' type='submit' name='id_edit' value='$id' >Перезаписать</button>
        </form>";
    }



    if($sort!='name_user' && $sort!='text' && $sort!='email' && $sort!='date' && $sort!='status')$sort='';//защита
    if($sort=='email')$sort='е-mail';

    $mas=$model->readTask($sort,$DESC,$page);
    echo "<h3>$message</h3>";
    include 'v_table.php';
    ?>

</div>

</body>
</html>
