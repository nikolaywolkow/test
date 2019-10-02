<?php

class bd_work
{
    function __construct()
    {
        $this->host = 'localhost';
        $this->database = 'nikolaywolkow';
        $this->user = 'rootwolkow';
        $this->password = 'root5Root';

    }
    function BD_zap($query)
    {
        $mysqli = new mysqli("$this->host", "$this->user", "$this->password", "$this->database");
        $result = $mysqli->query($query);
        mysqli_close($mysqli);
        return $result;
    }
    function writeTask($textTask,$email,$autor='')
    {
        if($autor=='')$autor='аноним';
        $query="INSERT INTO `task` (`id_task`, `text`, `е-mail`, `name_user`, `date`, `status`, `metka`) VALUES (NULL, '$textTask', '$email', '$autor', SYSDATE(), 'Принято к исполнению', '');";
        $result=$this->BD_zap($query);
        return $result;
    }
    function readTask($sort='',$DESC='',$lim=0)
    {
        $lim*=3;
        $mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
        $query="SELECT * FROM `task` ORDER BY `task`.`id_task` DESC LIMIT $lim,3";
        if($sort!='')$query="SELECT * FROM `task` ORDER BY `task`.`$sort` ASC LIMIT $lim,3";
        if($DESC!='')$query="SELECT * FROM `task` ORDER BY `task`.`$sort` DESC LIMIT $lim,3";

        $result=$this->BD_zap($query);
        $index=0;
        while($row = $result->fetch_array()){
            $mas[$index][text]=$row['text'];
            $mas[$index][email]=$row['е-mail'];
            $mas[$index][name_user]=$row['name_user'];
            $mas[$index][date]=$row['date'];
            $mas[$index][status]=$row['status'];
            $mas[$index][id]=$row['id_task'];
            $mas[$index][metka]=$row['metka'];
            $index++;
        }
        $result->free();
        $mysqli->close();
        return $mas;
    }
    function get_count()
    {
        $query="SELECT count(*) FROM `task`;";
        $result=$this->BD_zap($query);
        $count=mysqli_fetch_row($result);
        return $count[0];
    }
    function status_gotovo($id)
    {
        $query="UPDATE `task` SET `status` = 'Готово' WHERE `task`.`id_task` = $id;";
        $this->BD_zap($query);
    }
    function get_text_task($id)
    {
        $query="SELECT `text` FROM `task` WHERE `task`.`id_task`='$id'";
        $result=$this->BD_zap($query);
        $count=mysqli_fetch_row($result);
        return $count[0];
    }
    function edit_text_task($id,$text)
    {
        $old_text=$this->get_text_task($id);
        if($old_text==$text)return;

        $query="UPDATE `task` SET `text` = '$text' WHERE `task`.`id_task` = $id;";
        $result=$this->BD_zap($query);

        $query="UPDATE `task` SET `metka` = 'отредактировано администратором' WHERE `task`.`id_task` = $id;";
        $result=$this->BD_zap($query);

        return "Задача № $id успешно отредактирована";
    }


}
