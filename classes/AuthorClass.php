<?php
class AuthorDetails {
	public function __construct() {
        return true;
    }

    public $id;
    public $username;
    public $lastactivity;
    public $resources;
    public $link;
}

class AuthorResources {
	public function __construct() {
        return false;
    }

    
}