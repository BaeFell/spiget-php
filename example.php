<?php
require_once('spiget.php');

echo "Current available resource list users:<br>";
foreach(getResources() as $name => $id) {
	$resource = getResource($name, true); // true = full resource info includes; description, content, lastest version info and author
	echo $resource->ResourceAuthor->username . "<br>";
}
