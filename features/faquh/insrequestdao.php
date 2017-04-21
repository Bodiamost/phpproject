<?php

class InsrequestDAO
{

    public function addList($db,$question,$answer,$curdate){

        $query = "INSERT INTO faq(question,answer,curdate) 
                  VALUES (:question,:answer,:curdate)";// var values
        $pdostmt2 = $db->prepare($query); // already have connection just write this
        $pdostmt2->bindValue(':question',$question); //
        $pdostmt2->bindValue(':answer',$answer);
        $pdostmt2->bindValue(':curdate',$curdate);
        $pdostmt2->execute(); // executing the values
        header("Location: features/faq/listfaq.php");//header("Location: listfaq.php");
        $pdostmt2->closeCursor();
        return true;
    }
}