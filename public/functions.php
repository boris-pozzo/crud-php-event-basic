<?php

function get_event_list(){
    include "../connection.php";

    try{
        return $reponse = $connection->query("SELECT * FROM event");
    } catch(PDOException $e){
       echo "Error : ". $e->getMessage();
       return false; 
    }
}

function get_event($id){
    include "../connection.php";

    try{
        $sql= "SELECT * FROM event WHERE id= ?";
        $result=$connection->prepare($sql);
        $result->bindValue(1, $id, PDO::PARAM_INT);
        $result->execute();
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return $result->fetch();
}

function add_event($name, $surname, $passwordd, $id=null){
    include "../connection.php";

    if($id){
        $sql = "UPDATE event SET name = ?, surname = ?, passwordd = ? WHERE id = ?";
    } else {
        $sql = "INSERT INTO event (name, surname, passwordd) VALUE(?, ?, ?)";
    }

    try{
        $result= $connection->prepare($sql);
        $result->bindValue(1, $name, PDO::PARAM_STR);
        $result->bindValue(2, $surname, PDO::PARAM_STR);
        $result->bindValue(3, $passwordd, PDO::PARAM_STR);
        if($id){
            $result->bindValue(4, $id,PDO::PARAM_INT);
        }
        $result->execute();
    } catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return true;
}

function delete_event($id){
    include "../connection.php";

    $sql="DELETE FROM event WHERE id= ?";

    try{
        $result=$connection->prepare($sql);
        $result->bindValue(1, $id, PDO::PARAM_INT);
        $result->execute();
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return true;
}
?>