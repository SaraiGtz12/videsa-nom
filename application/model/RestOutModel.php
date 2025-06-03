<?php
class RestOutModel {
    public $error;
    public $msg;
    public $status;
    public $item;
    
    function __construct() {
        $this->error = NULL;
        $this->msg = NULL;
        $this->status = TRUE;
        $this->item = NULL;
    }
    
}