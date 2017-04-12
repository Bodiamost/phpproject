<?php

class CafeDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }

    public function getCategories(){
        $query ="SELECT * FROM restaurants_categories";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $categories=$pdostmt->fetchAll(PDO::FETCH_CLASS,"CafeCat");
        return $categories;
    }
    public function getCafes(){
        $query ="SELECT * FROM restaurants";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $cafes=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Cafe");
        return $cafes;
    }
    public function getUserCafes($user_id){
        $query ="SELECT * FROM restaurants WHERE posted_by=:usr;";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':usr',$user_id,PDO::PARAM_STR);
        $pdostmt->execute();

        $cafes=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Cafe");
        return $cafes;
    }
    public function getApprovedCafes(){
        $query ="SELECT * FROM restaurants WHERE approved=1";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $cafes=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Cafe");
        return $cafes;
    }

    public function getApprovedCafesJSON($page=0,$limit=12){
        $query ="SELECT * FROM restaurants r JOIN item_types i ON r.global_type=i.type_id WHERE approved=1 LIMIT ".$limit." OFFSET ".$limit*$page.";";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $cafes=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Cafe");
        return $cafes;
    }
    public function getApprovedCafesBylocationJSON($lat,$lng,$zoom,$page=0,$limit=12){
        $query ="SELECT *,( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
                cos( radians(   lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin(radians(lat)) ) )  AS distance 
                FROM restaurants r JOIN item_types i ON r.global_type=i.type_id WHERE approved=1  HAVING distance < :zoom ORDER BY distance LIMIT ".$limit." OFFSET ".$limit*$page.";";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$lng,PDO::PARAM_STR);
        $pdostmt->bindValue(':zoom',$zoom,PDO::PARAM_STR);
        $pdostmt->execute();

        $cafes=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Cafe");
        return $cafes;
    }
     public function getApprovedCafesBylocation($lat,$lng,$zoom){
        $query ="SELECT *,( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
                cos( radians(   lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin(radians(lat)) ) )  AS distance 
                FROM restaurants WHERE approved=1  HAVING distance < :zoom ORDER BY distance LIMIT 0 , 20 ";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$lng,PDO::PARAM_STR);
        $pdostmt->bindValue(':zoom',$zoom,PDO::PARAM_STR);
        $pdostmt->execute();

        $cafes=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Cafe");
        return $cafes;
    }
    public function getCafe($id){
        $query ="SELECT * FROM restaurants WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$id,PDO::PARAM_STR);
        $pdostmt->setFetchMode(PDO::FETCH_CLASS, 'Cafe'); 
        $pdostmt->execute();

        $cafe=$pdostmt->fetch();
        return $cafe;
    }
    public function updateCafe($cafe){
        $query ="UPDATE restaurants SET cat_id=:cat,title=:title,image=:img,description=:desctmp,contact=:contact,address=:address,working_hours=:hours,lat=:lat,lng=:lng,approved=:apvd,verified=:vrd WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$cafe->getId(),PDO::PARAM_STR);        
        $pdostmt->bindValue(':cat',$cafe->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':title',$cafe->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$cafe->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$cafe->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':hours',$cafe->getHours(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$cafe->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$cafe->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$cafe->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$cafe->getLng(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$cafe->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$cafe->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function addCafe($cafe){
        $query ="INSERT INTO restaurants (title,cat_id,image,description,contact,address,working_hours,lat,lng,rating,posted_by,posted_date,approved,verified) VALUES(:title,:catid,:img,:desctmp,:contact,:address,:hours,:lat,:lng,:rating,:pby,:pdate,:apvd,:vrd)";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':title',$cafe->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$cafe->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':hours',$cafe->getHours(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$cafe->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$cafe->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$cafe->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$cafe->getLng(),PDO::PARAM_STR);

        $pdostmt->bindValue(':catid',$cafe->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$cafe->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':rating',$cafe->getRating(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pby',$cafe->getPostedBy(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pdate',$cafe->getPosted(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$cafe->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$cafe->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function deleteCafe($cafe){
        $query ="DELETE FROM restaurants WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$cafe->getId(),PDO::PARAM_STR);
        
        return $pdostmt->execute();
    }
}

class CafeCat
{

}
class Cafe implements JsonSerializable
{
    private $id;    
    private $item_title='restaurant';
    private $global_type='3';
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

    public function jsonSerialize() {
        return ['id' => $this->id,
                'global_type' => $this->global_type,
                'item_title' => $this->item_title,
                'cat_id' => $this->cat_id,
                'title' => $this->title,
                'image' => $this->image,
                'description' => $this->description,    
                'contact' => $this->contact,
                'address' => $this->address, 
                'lat' => $this->lat,
                'lng' => $this->lng, 
                'working_hours' => $this->working_hours, 
                'rating' => $this->rating,
                'posted_by' => $this->posted_by,
                'posted_date' => $this->posted_date,
                'approved' => $this->approved,
                'verified' => $this->verified];
    }
}