<?php
if(isset($_GET['sort']))
$DESC='DESC';
if(isset($_GET['DESC']))
$DESC='';

?>
<table border="1" class="table w-75">
    <thead class="thead-dark">
    <tr>
        <th onclick='location.href="?sort=name_user&<?php echo $DESC?>"'>Имя пользователя</th>
        <th onclick='location.href="?sort=text&<?php echo $DESC?>"'>Задача</th>
        <th onclick='location.href="?sort=email&<?php echo $DESC?>"'>E-mail</th>
        <th onclick='location.href="?sort=date&<?php echo $DESC?>"'>Время добавления</th>
        <th onclick='location.href="?sort=status&<?php echo $DESC?>"'>Статус задачи</th>
        <th>Доп. инф</th>
        <?php if($autor=='Admin')echo "<th>Редактировать</th>";?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        foreach ($mas as $el)
        {
            echo "<tr><td>$el[name_user]</td><td>$el[text]</td><td>$el[email]</td><td>$el[date]</td><td>$el[status]</td><td>$el[metka]</td>";
            if($autor=='Admin')echo "<td><a href='?gotovo=$el[id]'>Выполнено</a><br><a href='?edit=$el[id]'>Редактировать</a></td>";
            echo '</tr>';
        }
        ?>
    </tr>
    </tbody>
</table>

<form method="post">
    <?php
    $count=$model->get_count();
    $count=$count/3;
    for($i=1;$i<$count+1;$i++)
    {
        echo "<button name='page' value='$i' type='submit' class='btn btn-outline-secondary'>$i</button>";
    }
    ?>
</form>
