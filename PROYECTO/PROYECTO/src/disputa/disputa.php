<?php
class disputa {
    public $id;
    public $receipt_id;
    public $user_id;
    public $reason;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->receipt_id = $data['receipt_id']?? null;
        $this->user_id = $data['user_id']?? null;
        $this->reason = $data['reason'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? 'open';
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at']?? null;
    }
}