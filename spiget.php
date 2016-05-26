<?php
#
#	spiget.php
#	By nfell2009
#	All rights reserved
#
function __autoload($classname) {
	if(strpos($classname, "Resource") !== FALSE) { $classname = "Resource"; }
	if(strpos($classname, "Category") !== FALSE) { $classname = "ResourceCategories"; }
	if(strpos($classname, "Author") !== FALSE) { $classname = "AuthorClass"; }
    $filename = "./classes/". $classname .".php";
    include_once($filename);
}

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

function setVars($input, $json) {
	foreach($json as $key => $value) {
		$key = strtolower($key);
		if(strpos($key, ".") !== FALSE) {
			$newkey = str_replace(".", "", $key);
			$input->$newkey = $json->{$key};
		} else {
			$input->$key = $value;
		}
	}
	return $input;
}

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
function getResource($id, $full = true) {
	global $fullhost, $context;
	$cont = file_get_contents($fullhost . 'resources/' . $id, false, $context);
	$json = json_decode($cont);
	$resource = new Resource();
	$resource = setVars($resource, $json);
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
	$id = $resource;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/content', false, $context);
	$json = json_decode($cont);
	$resourcecontent = new ResourceContent();
	$resourcecontent = setVars($resourcecontent, $json);
	if ($resource instanceof Resource) {
		$resource->ResourceContent = $resourcecontent;
		return $resource;
	} else {
		return $resourcecontent;
	}
}
function getResourceDescription($resource) {
	global $fullhost, $context;
	$id = $resource;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/description', false, $context);
	$json = json_decode($cont);
	$resourcedescription = new ResourceDescription();
	$resourcedescription = setVars($resourcedescription, $json);
	if ($resource instanceof Resource) {
		$resource->ResourceDescription = $resourcedescription;
		return $resource;
	} else {
		return $resourcedescription;
	}
}
function getResourceVersions($resource, $version = "latest") {
	global $fullhost, $context;
	$id = $resource;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/versions/' . $version, false, $context);
	$json = json_decode($cont);
	$resourceversions = new ResourceVersions();
	$resourceversions = setVars($resourceversions, $json);
	if ($resource instanceof Resource) {
		$resource->ResourceVersions = $resourceversions;
		return $resource;
	} else {
		return $resourceversions;
	}
}
function getResourceAuthor($resource) {
	global $fullhost, $context;
	$id = $resource;
	if ($resource instanceof Resource) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'resources/' . $id . '/author', false, $context);
	$json = json_decode($cont);
	$resourceauthor = new ResourceAuthor();
	$resourceauthor = setVars($resourceauthor, $json);
	if ($resource instanceof Resource) {
		$resource->ResourceAuthor = $resourceauthor;
		return $resource;
	} else {
		return $resourceauthor;
	}
}

function getNewResources($size = 0) {
	global $fullhost, $context;
	if($size == 0) {
		$cont = file_get_contents($fullhost . 'resources/new', false, $context);
	} else {
		$cont = file_get_contents($fullhost . 'resources/new?size=' . $size, false, $context);
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

function getResourceCategories() {
	global $fullhost, $context;
	$cont = file_get_contents($fullhost . 'categories', false, $context);
	$json = json_decode($cont);
	$out = array();
	foreach($json as $j) {
		$id       = $j->id;
		$name     = $j->name;
		$out[$id] = $name;
	}
	return $out;
}

function getCategoryDetails($resource) {
	global $fullhost, $context;
	$id = $resource;
	if($resource instanceof Resource) {
		$id = $resource->categoryid;
	}
	$cont = file_get_contents($fullhost . 'categories/' . $id, false, $context);
	$json = json_decode($cont);
	$categorydetails = new CategoryDetails();
	$categorydetails = setVars($categorydetails, $json);
	return $categorydetails;
}

function getCategoryResources($resource, $size = 0) {
	global $fullhost, $context;
	$id = $resource;
	if($resource instanceof Resource) {
		$id = $resource->categoryid;
	}
	if($size == 0) {
		$cont = file_get_contents($fullhost . 'categories/' . $id . 'resources', false, $context);
	} else {
		$cont = file_get_contents($fullhost . 'categories/' . $id . '/resources?size=' . $size, false, $context);
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

function getAuthors($size = 0) {
	global $fullhost, $context;
	if($size == 0) {
		$cont = file_get_contents($fullhost . 'authors', false, $context);
	} else {
		$cont = file_get_contents($fullhost . 'authors?size=' . $size, false, $context);
	}
	$json = json_decode($cont);
	$out = array();
	foreach($json as $j) {
		$id       = $j->id;
		$name     = $j->username;
		$out[$id] = $name;
	}
	return $out;
}

function getNewAuthors($size = 0) {
	global $fullhost, $context;
	if($size == 0) {
		$cont = file_get_contents($fullhost . 'authors/new', false, $context);
	} else {
		$cont = file_get_contents($fullhost . 'authors/new?size=' . $size, false, $context);
	}
	$json = json_decode($cont);
	$out = array();
	foreach($json as $j) {
		$id       = $j->id;
		$name     = $j->username;
		$out[$id] = $name;
	}
	return $out;
}

function getAuthorDetails($resource) {
	global $fullhost, $context;
	$id = $resource;
	if($resource instanceof Resource) {
		$id = $resource->author;
	}
	$cont = file_get_contents($fullhost . 'authors/' . $id, false, $context);
	$json = json_decode($cont);
	$authordetails = new AuthorDetails();
	$authordetails = setVars($authordetails, $json);
	return $authordetails;
}

function search($type, $query) {
	global $fullhost, $context;
	$cont = file_get_contents($fullhost . 'search/' . $type . $query, false, $context);
	$json = json_decode($cont);
	$out = array();
	foreach($json as $j) {
		$id       = $j->id;
		$name     = $j->username;
		$out[$id] = $name;
	}
	return $out;
}

function searchResources($query) {
	return search("resources/", $query);
}

function searchAuthors($query) {
	return search("authors/", $query);
}

function downloadResource($resource, $path = "./downloads/{resourece-name}") {
	global $fullhost, $context;
	$id = $resource;
	if($resource instanceof Resource) {
		$id = $resource->name;
	}
	$path = str_replace("{resource-name}", $id, $path);
	$url  = $fullhost . $id . "/download";
	return downloadFile($url, $path);
}

function downloadResourceForVersion($resource, $version = "latest", $path = "./downloads/{resourece-name}") {
	global $fullhost, $context;
	$id = $resource;
	if($resource instanceof Resource) {
		$id = $resource->name;
	}
	$path = str_replace("{resource-name}", $id, $path);
	$url  = $fullhost . $id . "/versions/" . $version . "/download";
	return downloadFile($url, $path);
}

function downloadFile($url, $path)
{
    $newfname = $path;
    $file = fopen ($url, 'rb');
    if ($file) {
        $newf = fopen ($newfname, 'wb');
        if ($newf) {
            while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
        }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
        return $newf;
    }
}

function resourcesOfAuthor($resource) {
	global $fullhost, $context;
	$id = $resource;
	if($resource instanceof Resource) {
		$id = $resource->author;
	} else if ($resource instanceof AuthorDetails) {
		$id = $resource->id;
	}
	$cont = file_get_contents($fullhost . 'authors/' . $id . "/resources", false, $context);
	$json = json_decode($cont);
	$out = array();
	foreach($json as $j) {
		$resource = new Resource();
		$resource = setVars($resource, $j);
		array_push($out, $resource);
	}
	return $out;

}
?>