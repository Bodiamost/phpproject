<?php

class PlaceDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }

    public function getCategories(){
        $query ="SELECT * FROM places_categories";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $categories=$pdostmt->fetchAll(PDO::FETCH_CLASS,"PlaceCat");
        return $categories;
    }
    public function getPlaces(){
        $query ="SELECT * FROM places";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $places=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Place");
        return $places;
    }
    public function getApprovedPlaces(){
        $query ="SELECT * FROM places WHERE approved=1";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $places=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Place");
        return $places;
    }
     public function getApprovedPlacesBylocation($lat,$lng,$zoom){
        $query ="SELECT *,( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
                cos( radians(   lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin(radians(lat)) ) )  AS distance 
                FROM places WHERE approved=1  HAVING distance < :zoom ORDER BY distance LIMIT 0 , 20 ";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$lng,PDO::PARAM_STR);
        $pdostmt->bindValue(':zoom',$zoom,PDO::PARAM_STR);
        $pdostmt->execute();

        $places=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Place");
        return $places;
    }
    public function getPlace($id){
        $query ="SELECT * FROM places WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$id,PDO::PARAM_STR);
        $pdostmt->setFetchMode(PDO::FETCH_CLASS, 'Place'); 
        $pdostmt->execute();

        $place=$pdostmt->fetch();
        return $place;
    }
    public function updatePlace($place){
        $query ="UPDATE places SET cat_id=:cat,title=:title,image=:img,description=:desctmp,contact=:contact,address=:address,working_hours=:hours,lat=:lat,lng=:lng,approved=:apvd,verified=:vrd WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$place->getId(),PDO::PARAM_STR);        
        $pdostmt->bindValue(':cat',$place->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':title',$place->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$place->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$place->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':hours',$place->getHours(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$place->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$place->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$place->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$place->getLng(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$place->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$place->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function addPlace($place){
        $query ="INSERT INTO places (title,cat_id,image,description,contact,address,working_hours,lat,lng,rating,posted_by,posted_date,approved,verified) VALUES(:title,:catid,:img,:desctmp,:contact,:address,:hours,:lat,:lng,:rating,:pby,:pdate,:apvd,:vrd)";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':title',$place->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$place->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':hours',$place->getHours(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$place->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$place->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$place->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$place->getLng(),PDO::PARAM_STR);

        $pdostmt->bindValue(':catid',$place->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$place->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':rating',$place->getRating(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pby',$place->getPostedBy(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pdate',$place->getPosted(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$place->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$place->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function deletePlace($place){
        $query ="DELETE FROM places WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$place->getId(),PDO::PARAM_STR);
        
        return $pdostmt->execute();
    }
}

class PlaceCat
{

}
class Place
{
    private $id;
    private $cat_id;
    private $title;
    private $image;
    private $description;    
    private $contact; 
    private $address; 
    private $lat=0; 
    private $lng=0; 
    private $working_hours; 
    private $rating=0;
    private $posted_by;
    private $posted_date;
    private $approved=0;
    private $verified=0;
    
    public function getId()
    {
        return $this->id;
    } 
    public function getCid()
    {
        return $this->cat_id;
    }  
    public function setCid($value)
    {
        $this->cat_id=$value;
    }
    public function getTitle()
    {
        return $this->title;
    }  
    public function setTitle($value)
    {
        $this->title=$value;
    }
    public function getImage()
    {
        return $this->image;
    }  
    public function setImage($value)
    {
        $this->image=$value;
    }
    public function getDesc()
    {
        return $this->description;
    }  
    public function setDesc($value)
    {
        $this->description=$value;
    }
    public function getContact()
    {
        return $this->contact;
    }  
    public function setContact($value)
    {
        $this->contact=$value;
    }
    public function getAddress()
    {
        return $this->address;
    }  
    public function setAddress($value)
    {
        $this->address=$value;
    }
    public function getLat()
    {
        return $this->lat;
    }  
    public function setLat($value)
    {
        $this->lat=$value;
    }
    public function getLng()
    {
        return $this->lng;
    }  
    public function setLng($value)
    {
        $this->lng=$value;
    }
    public function getHours()
    {
        return $this->working_hours;
    }  
    public function setHours($value)
    {
        $this->working_hours=$value;
    }
    public function getRating()
    {
        return $this->rating;
    }  
    public function setRating($value)
    {
        $this->rating=$value;
    }
    public function getPostedBy()
    {
        return $this->posted_by;
    }  
    public function setPostedBy($value)
    {
        $this->posted_by=$value;
    }
    public function getPosted()
    {
        return $this->posted_date;
    }  
    public function setPosted($value)
    {
        $this->posted_date=$value;
    }
    public function getApproved()
    {
        return $this->approved;
    }  
    public function setApproved($value)
    {
        $this->approved=$value;
    }
    public function getVerified()
    {
        return $this->verified;
    }  
    public function setVerified($value)
    {
        $this->verified=$value;
    }
}