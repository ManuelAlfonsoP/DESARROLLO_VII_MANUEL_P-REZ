<?php
class Review {
    public $id;
    public $product_id;
    public $user_id;
    public $rating;
    public $comment;
    public $created_at;

    public function __construct($data) {
        $this->id = $data['id']?? null;
        $this->product_id = $data['product_id']?? null;
        $this->user_id = $data['user_id']?? null;
        $this->rating= $data['rating'] ?? null;
        $this->comment= $data['comment'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
    }
}