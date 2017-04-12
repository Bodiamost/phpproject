<?php

class TripDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }

    public function getCategories(){
        $query ="SELECT * FROM trip_categories";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $categories=$pdostmt->fetchAll(PDO::FETCH_CLASS,"TripCat");
        return $categories;
    }
    public function getTrips(){
        $query ="SELECT * FROM trips";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->execute();

        $trips=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Trip");
        return $trips;
    }
    public function getUserTrips($user_id){
        $query ="SELECT * FROM trips WHERE posted_by=:usr;";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':usr',$user_id,PDO::PARAM_STR);
        $pdostmt->execute();
        
        $trips=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Trip");
        return $trips;
    }

    public function getTripsBylocation($lat,$lng,$zoom){
        $query ="SELECT *,( 3959 * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * 
                cos( radians(   lng ) - radians(:lng) ) + sin( radians(:lat) ) * sin(radians(lat)) ) )  AS distance 
                FROM trips HAVING distance < :zoom ORDER BY distance LIMIT 0 , 20 ";

        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$lng,PDO::PARAM_STR);
        $pdostmt->bindValue(':zoom',$zoom,PDO::PARAM_STR);
        $pdostmt->execute();

        $trips=$pdostmt->fetchAll(PDO::FETCH_CLASS,"Trip");
        return $trips;
    }

    public function getTrip($id){
        $query ="SELECT * FROM trips WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$id,PDO::PARAM_STR);
        $pdostmt->setFetchMode(PDO::FETCH_CLASS, 'Trip'); 
        $pdostmt->execute();

        $trip=$pdostmt->fetch();
        return $trip;
    }
    /*public function updateTrip($trip){
        $query ="UPDATE trips SET cat_id=:cat,title=:title,image=:img,description=:desctmp,contact=:contact,address=:address,working_hours=:hours,lat=:lat,lng=:lng,approved=:apvd,verified=:vrd WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$trip->getId(),PDO::PARAM_STR);        
        $pdostmt->bindValue(':cat',$trip->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':title',$trip->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$trip->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$trip->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':hours',$trip->getHours(),PDO::PARAM_STR);
        $pdostmt->bindValue(':contact',$trip->getContact(),PDO::PARAM_STR);
        $pdostmt->bindValue(':address',$trip->getAddress(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$trip->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$trip->getLng(),PDO::PARAM_STR);
        $pdostmt->bindValue(':apvd',$trip->getApproved(),PDO::PARAM_STR);
        $pdostmt->bindValue(':vrd',$trip->getVerified(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }*/
    public function addTrip($trip){
        $query ="INSERT INTO trips (title,cat_id,image,description,date_start,date_end,items,trip_location,lat,lng,rating,posted_by,posted_date,status) VALUES(:title,:catid,:img,:desctmp,:date_s,:date_e,:items,:t_loc,:lat,:lng,:rating,:pby,:pdate,:status)";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':title',$trip->getTitle(),PDO::PARAM_STR);
        $pdostmt->bindValue(':desctmp',$trip->getDesc(),PDO::PARAM_STR);
        $pdostmt->bindValue(':date_s',$trip->getDateStart(),PDO::PARAM_STR);
        $pdostmt->bindValue(':date_e',$trip->getDateEnd(),PDO::PARAM_STR);
        $pdostmt->bindValue(':items',$trip->getItems(),PDO::PARAM_STR);
        $pdostmt->bindValue(':t_loc',$trip->getLocation(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lat',$trip->getLat(),PDO::PARAM_STR);
        $pdostmt->bindValue(':lng',$trip->getLng(),PDO::PARAM_STR);

        $pdostmt->bindValue(':catid',$trip->getCid(),PDO::PARAM_STR);
        $pdostmt->bindValue(':img',$trip->getImage(),PDO::PARAM_STR);
        $pdostmt->bindValue(':rating',$trip->getRating(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pby',$trip->getPostedBy(),PDO::PARAM_STR);
        $pdostmt->bindValue(':pdate',$trip->getPosted(),PDO::PARAM_STR);
        $pdostmt->bindValue(':status',$trip->getStatus(),PDO::PARAM_STR);

        return $pdostmt->execute();
    }
    public function deleteTrip($trip){
        $query ="DELETE FROM trips WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$trip->getId(),PDO::PARAM_STR);
        
        return $pdostmt->execute();
    }
}

class TripCat
{
}


class Trip implements JsonSerializable
{
    private $id;
    private $item_title='trip';
    private $global_type='4';
    private $cat_id;
    private $title;
    private $image;
    private $description;    
    private $date_start; 
    private $date_end; 
    private $items; 
    private $trip_location;    
    private $lat=0; 
    private $lng=0;  
    private $rating=0;
    private $posted_by;
    private $posted_date;
    private $status=0;
    
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
    public function getDateStart()
    {
        return $this->date_start;
    }  
    public function setDateStart($value)
    {
        $this->date_start=$value;
    }
    public function getDateEnd()
    {
        return $this->date_end;
    }  
    public function setDateEnd($value)
    {
        $this->date_end=$value;
    }
    public function getItems()
    {
        return $this->items;
    }  
    public function setItems($value)
    {
        $this->items=$value;
    }
    public function getLocation()
    {
        return $this->trip_location;
    }  
    public function setLocation($value)
    {
        $this->trip_location=$value;
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
    public function getStatus()
    {
        return $this->status;
    }  
    public function setStatus($value)
    {
        $this->status=$value;
    }
    public function jsonSerialize() {
        return ['id' => $this->id,
                'global_type' => $this->global_type,
                'item_title' => $this->item_title,
                'cat_id' => $this->cat_id,
                'title' => $this->title,
                'image' => $this->image,
                'description' => $this->description,    
                'date_start' => $this->date_start, 
                'date_end' => $this->date_end,
                'items' => $this->items, 
                'trip_location' => $this->trip_location, 
                'lat' => $this->lat,
                'lng' => $this->lng, 
                'rating' => $this->rating,
                'posted_by' => $this->posted_by,
                'posted_date' => $this->posted_date,
                'status' => $this->status];
    }
}
/**
* 
*/