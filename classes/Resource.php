<?php
class Resource {
	public function __construct() {
        return true;
    }

	public $id;
	public $name;
	public $tag;
	public $lastupdate;
	public $authorid;
	public $download;
	public $link;
	public $version;
	public $versions;
	public $categoryid;
	public $external;
	public $filesize;
	public $icon;
	public $contrib;
	public $contributors;
	public $testedversions;
	public $ratingauthors;
	public $ratingaverage;
	public $ResourceContent;
	public $ResourceDescription;
	public $ResourceVersions;
	public $ResourceAuthor;
}

class ResourceContent {
	public function __construct() {
        return true;
    }
	public $id;
	public $name;
	public $contenttype;
	public $contentdescription;
	public $contentfiles;
	public $contentskript;
}

class ResourceDescription {
	public function __construct() {
        return true;
    }
	public $id;
	public $name;
	public $tag;
	public $description;
}

class ResourceVersions {
	public function __construct() {
        return true;
    }
	public $version;
	public $releasedate;
	public $download;
}

class ResourceAuthor {
	public function __construct() {
        return true;
    }
	public $id;
	public $username;
	public $lastactivity;
	public $resources;
	public $link;
}