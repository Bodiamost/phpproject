<?php

class EventDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }

    public function getCategories(){
        $query ="SELECT * FROM events_categories";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $categories=$pdostmt->fetchAll(PDO::FETCH_CLASS,"EventCat");
        return $categories;
    }
    public function getEvents(){
        $query ="SELECT * FROM events";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $events=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Event");
        return $events;
    }
    public function getUserEvents($user_id){
        $query ="SELECT * FROM events WHERE posted_by=:usr;";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':usr',$user_id,PDO::PARAM_STR);
        $pdostmt->execute();

        $events=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Event");
        return $events;
    }
    public function getApprovedEvents(){
        $query ="SELECT * FROM events WHERE approved=1";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $events=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Event");
        return $events;
    }
    public function getApprovedEventsJSON($page=0,$limit=12){
        $query ="SELECT * FROM events e JOIN item_types i ON e.global_type=i.type_id WHERE approved=1 LIMIT ".$limit." OFFSET ".$limit*$page.";";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $events=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Event");
        return $events;
    }
    public function getApprovedEventsBylocationJSON($lat,$lng,$zoom,$start_date,$end_date,$page=0,$limit=12){
        $query ="SELECT *,( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
                cos( radians(   lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin(radians(lat)) ) )  AS distance 
                FROM events e JOIN item_types i ON e.global_type=i.type_id WHERE approved=1 AND event_end>:sd AND event_start<:ed HAVING distance < :zoom ORDER BY distance LIMIT ".$limit." OFFSET ".$limit*$page.";";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$lng,PDO::PARAM_STR);
        $pdostmt->bindValue(':zoom',$zoom,PDO::PARAM_STR);
        $pdostmt->bindValue(':sd',$start_date,PDO::PARAM_STR);
        $pdostmt->bindValue(':ed',$end_date,PDO::PARAM_STR);
        $pdostmt->execute();

        $events=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Event");
        return $events;
    }
    public function getApprovedEventsBylocation($lat,$lng,$zoom,$start_date,$end_date){
        $query ="SELECT *,( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
                cos( radians(   lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin(radians(lat)) ) )  AS distance 
                FROM events WHERE approved=1 AND event_end>:sd AND event_start<:ed HAVING distance < :zoom ORDER BY distance LIMIT 0 , 20 ";

        $pdostmt=$this->db->prepare($query);

        $pdostmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$lng,PDO::PARAM_STR);
        $pdostmt->bindValue(':zoom',$zoom,PDO::PARAM_STR);
        $pdostmt->bindValue(':sd',$start_date,PDO::PARAM_STR);
        $pdostmt->bindValue(':ed',$end_date,PDO::PARAM_STR);

        $pdostmt->execute();

        $events=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Event");
        return $events;
    }
    public function getEvent($id){
        $query ="SELECT * FROM events WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$id,PDO::PARAM_STR);
        $pdostmt->setFetchMode(PDO::FETCH_CLASS, 'Event'); 
        $pdostmt->execute();

        $event=$pdostmt->fetch();
        return $event;
    }
    public function updateEvent($event){
        $query ="UPDATE events SET cat_id=:cat,title=:title,image=:img,description=:desctmp,contact=:contact,address=:address,event_start=:h_s,event_end=:h_e,lat=:lat,lng=:lng,approved=:apvd,verified=:vrd WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$event->getId(),PDO::PARAM_STR);        
        $pdostmt->bindValue(':cat',$event->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':title',$event->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$event->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$event->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':h_s',$event->getStart(),PDO::PARAM_STR);
        $pdostmt->bindValue(':h_e',$event->getEnd(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$event->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$event->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$event->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$event->getLng(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$event->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$event->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function addEvent($event){
        $query ="INSERT INTO events (title,cat_id,image,description,contact,address,event_start,event_end,lat,lng,rating,posted_by,posted_date,approved,verified) VALUES(:title,:catid,:img,:desctmp,:contact,:address,:h_s,:h_e,:lat,:lng,:rating,:pby,:pdate,:apvd,:vrd)";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':title',$event->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$event->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':h_s',$event->getStart(),PDO::PARAM_STR);
        $pdostmt->bindValue(':h_e',$event->getEnd(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$event->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$event->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$event->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$event->getLng(),PDO::PARAM_STR);

        $pdostmt->bindValue(':catid',$event->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$event->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':rating',$event->getRating(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pby',$event->getPostedBy(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pdate',$event->getPosted(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$event->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$event->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function deleteEvent($event){
        $query ="DELETE FROM events WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$event->getId(),PDO::PARAM_STR);
        
        return $pdostmt->execute();
    }
}

class EventCat
{

}
class Event implements JsonSerializable
{
    private $id;
    private $item_title='event';
    private $global_type='2';
    private $cat_id;
    private $title;
    private $image;
    private $description;    
    private $contact; 
    private $address; 
    private $lat=0; 
    private $lng=0; 
    private $event_start;
    private $event_end; 
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
    public function getStart()
    {
        return $this->event_start;
    }  
    public function setStart($value)
    {
        $this->event_start=$value;
    }
    public function getEnd()
    {
        return $this->event_end;
    }  
    public function setEnd($value)
    {
        $this->event_end=$value;
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
                'event_start' =>$this->event_start,
                'event_end' =>$this->event_end,
                'rating' => $this->rating,
                'posted_by' => $this->posted_by,
                'posted_date' => $this->posted_date,
                'approved' => $this->approved,
                'verified' => $this->verified];
    }
}