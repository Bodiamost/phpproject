<?php

class Faq
{
private $db;

public function __construct($db)
{
$this->db = $db;
}

public function listFaq(){
$query = "SELECT * FROM faq";
$pdostmt = $this->db->prepare($query);
$pdostmt-> execute();

$dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
return $dinos;
}

}
?>