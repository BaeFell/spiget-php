<?php
class Resource {
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
	public $id;
	public $name;
	public $contenttype;
	public $contentdescription;
	public $contentfiles;
	public $contentskript;
}

class ResourceDescription {
	public $id;
	public $name;
	public $tag;
	public $description;
}

class ResourceVersions {
	public $version;
	public $releasedate;
	public $download;
}

class ResourceAuthor {
	public $id;
	public $username;
	public $lastactivity;
	public $resources;
	public $link;
}