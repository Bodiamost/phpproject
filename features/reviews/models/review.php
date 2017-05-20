<?php

class reviewDAO
{
    private $db;

    public function __construct($db)
    {
        $this->db=$db;
    }

    public function getReviews($item_type,$id)
    {
        $query ="SELECT r.id, r.title,r.date,r.description,u.first_name,u.last_name,r.rating,v.user_id
        		FROM reviews r, visits v, usertb u WHERE v.item_type_id=:i_t_id AND v.item_id=:i_id 
        		AND r.visit_id=v.id AND r.visit_id=v.id AND v.user_id=u.id ORDER BY r.date DESC;";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':i_t_id',$item_type,PDO::PARAM_STR);
        $pdostmt->bindValue(':i_id',$id,PDO::PARAM_STR);
        $pdostmt->execute();
        $reviews=$pdostmt->fetchAll(PDO::FETCH_CLASS,"ReviewVisit");
        return $reviews;
    }
    public function saveVisit(&$visit)
    {
    	$query ="INSERT INTO visits (item_type_id,item_id,user_id,date,duration,loadness) VALUES(:it,:i,:u,:d,:du,:l)";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':it',$visit->item_type_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':i',$visit->item_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':u',$visit->user_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':d',$visit->date,PDO::PARAM_STR);
        $pdostmt->bindValue(':du',$visit->duration,PDO::PARAM_STR);
        $pdostmt->bindValue(':l',$visit->loadness,PDO::PARAM_STR);
        $pdostmt->execute();
        $visit->id=$this->getVisitId($visit);
    }
    public function getVisitId($visit)
    {
    	$query ="SELECT DISTINCT id FROM visits WHERE item_type_id=:it AND item_id=:i AND user_id=:u AND date=:d AND duration=:du AND loadness=:l";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':it',$visit->item_type_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':i',$visit->item_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':u',$visit->user_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':d',$visit->date,PDO::PARAM_STR);
        $pdostmt->bindValue(':du',$visit->duration,PDO::PARAM_STR);
        $pdostmt->bindValue(':l',$visit->loadness,PDO::PARAM_STR);
        $pdostmt->execute();
        $id=$pdostmt->fetch()['id'];
        return $id;	
    }

    public function saveReview($review)
    {
    	$query ="INSERT INTO reviews (visit_id,title,description,date,rating) VALUES(:vi,:t,:dp,:d,:r)";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':vi',$review->visit_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':t',$review->title,PDO::PARAM_STR);
        $pdostmt->bindValue(':dp',$review->description,PDO::PARAM_STR);
        $pdostmt->bindValue(':d',$review->date,PDO::PARAM_STR);
        $pdostmt->bindValue(':r',$review->rating,PDO::PARAM_STR);
        $pdostmt->execute();
        $review=$this->getReviewVisitByVisitId($review->visit_id);
        $this->updateItemRating($review);
    }

    public function deleteReview($review){
        $reviewold=$this->getReviewVisitByVisitId($review->visit_id);
        $query ="DELETE FROM reviews WHERE id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$review->id,PDO::PARAM_STR);
        $pdostmt->execute();
        $this->updateItemRating($reviewold);
    }

    public function getReviewVisitById($id){
        $query ="SELECT r.id,r.visit_id,v.item_type_id,v.item_id,r.title,v.user_id FROM reviews r, visits v WHERE r.id=:id AND r.visit_id=v.id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$id,PDO::PARAM_STR);
        $pdostmt->execute();
        $review=$pdostmt->fetchAll(PDO::FETCH_CLASS,"ReviewVisit");
        return $review[0];
    }
    public function getReviewVisitByVisitId($id){
        $query ="SELECT r.id,v.item_type_id,v.item_id,r.title,v.user_id, r.rating FROM reviews r, visits v WHERE v.id=:id AND r.visit_id=v.id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$id,PDO::PARAM_STR);
        $pdostmt->execute();
        $review=$pdostmt->fetchAll(PDO::FETCH_CLASS,"ReviewVisit");
        return $review[0];
    }

    public function updateItemRating($review){

        if($review->item_type_id=='1')
            $table="places";
        elseif($review->item_type_id=='2')
            $table="events";
        elseif($review->item_type_id=='3')
            $table="restaurants";
        elseif($review->item_type_id=='4')
            $table="trips";
        else
            return;
        $query ="UPDATE ".$table." p SET rating =(SELECT ROUND(AVG(r.rating)) FROM reviews r, visits v WHERE r.visit_id=v.id AND v.item_type_id=:typeid AND v.item_id=p.id) WHERE p.id=:id";
        $pdostmt=$this->db->prepare($query);
        $pdostmt->bindValue(':id',$review->item_id,PDO::PARAM_STR);
        $pdostmt->bindValue(':typeid',$review->item_type_id,PDO::PARAM_STR);
        return $pdostmt->execute();
    }

   
}

class Visit
{
	public $id;
	public $item_type_id;
	public $item_id;
	public $user_id;
	public $date;
	public $duration;
	public $loadness;
	
}
class Review
{
   	public $id;
	public $visit_id;
	public $title;
	public $description;
	public $date;
	public $rating;
}

class ReviewVisit extends Review
{
	//public $visit=new Visit();
   
}
