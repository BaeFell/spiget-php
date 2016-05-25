<?php
#
#	spiget.php
#	By nfell2009
#	All rights reserved
#

require('resource.php');

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: Spiget PHP by nfell2009\r\n"
  )
);
$context = stream_context_create($opts);

$host     = "https://api.spiget.org";
$version  = "v1";
$fullhost = $host . "/" . $version . "/";

function getResources($size = 0) {
	global $fullhost, $context;
	if($size == 0) {
		$cont = file_get_contents($fullhost . 'resources', false, $context);
	} else {
		$cont = file_get_contents($fullhost . 'resources/?size=' . $size, false, $context);
	}
	$json = json_decode($cont);
	$out = array();
	foreach($json as $j) {
		$id       = $j->id;
		$name     = $j->name;
	  	$out[$id] = $name;
	}
	return $out;
}

function getResource($id, $full) {
	global $fullhost, $context;
	$cont = file_get_contents($fullhost . 'resources/' . $id, false, $context);
	$json = json_decode($cont);
	$resource = new Resource();
	$resource->id = $json->id;
	$resource->name = $json->name;
	$resource->tag = $json->tag;
	$resource->lastupdate = $json->lastUpdate;
	$resource->authorid = $json->{'author.id'};
	$resource->download = $json->download;
	$resource->link = $json->link;
	$resource->version = $json->version;
	$resource->versions = $json->versions;
	$resource->categoryid = $json->{'category.id'};
	$resource->external = $json->external;
	$resource->filesize = $json->filesize;
	$resource->icon = $json->icon;
	$resource->contrib = $json->contributors;
	$resource->contributors = $json->contributors;
	$resource->testedversions = $json->testedVersions;
	$resource->ratingauthors = $json->{'rating.authors'};
	$resource->ratingaverage = $json->{'rating.average'};
	if($full) {
		$resource = getResourceContent($resource);
		$resource = getResourceDescription($resource);
		$resource = getResourceVersions($resource);
		$resource = getResourceAuthor($resource);
	}
	return $resource;
}

function getResourceContent($resource) {
	global $fullhost, $context;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/content', false, $context);
	$json = json_decode($cont);
	$resourcecontent = new ResourceContent();
	$resourcecontent->id = $json->id;
	$resourcecontent->name = $json->name;
	$resourcecontent->contenttype = $json->{'content.type'};
	$resourcecontent->contentdescription = $json->{'content.description'};
	$resourcecontent->contentfiles = $json->{'content.files'};
	$resourcecontent->contentskript = $json->{'content.skript'};
	if ($resource instanceof Resource) {
		$resource->ResourceContent = $resourcecontent;
		return $resource;
	} else {
		return $resourcecontent;
	}
}

function getResourceDescription($resource) {
	global $fullhost, $context;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/description', false, $context);
	$json = json_decode($cont);
	$resourcedescription = new ResourceDescription();
	$resourcedescription->id = $json->id;
	$resourcedescription->name = $json->name;
	$resourcedescription->contenttype = $json->tag;
	$resourcedescription->contentdescription = $json->description;
	if ($resource instanceof Resource) {
		$resource->ResourceDescription = $resourcedescription;
		return $resource;
	} else {
		return $resourcedescription;
	}
}

function getResourceVersions($resource, $version = "latest") {
	global $fullhost, $context;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/versions/' . $version, false, $context);
	$json = json_decode($cont);
	$resourceversions = new ResourceVersions();
	$resourceversions->version = $json->version;
	$resourceversions->releasedate = $json->releaseDate;
	$resourceversions->download = $json->download;
	if ($resource instanceof Resource) {
		$resource->ResourceVersions = $resourceversions;
		return $resource;
	} else {
		return $resourceversions;
	}
}

function getResourceAuthor($resource) {
	global $fullhost, $context;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/author', false, $context);
	$json = json_decode($cont);
	$resourceauthor = new ResourceAuthor();
	$resourceauthor->id = $json->id;
	$resourceauthor->username = $json->username;
	$resourceauthor->lastactivity = $json->lastActivity;
	$resourceauthor->resources = $json->resources;
	$resourceauthor->link = $json->link;
	if ($resource instanceof Resource) {
		$resource->ResourceAuthor = $resourceauthor;
		return $resource;
	} else {
		return $resourceauthor;
	}
}
?>
