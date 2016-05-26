# spiget-php
Access the Spiget.org API through PHP



#### Key
Feature | `function($required, [options = "default value], $suggestion|$other_suggestion)`: Supported ![tick](http://nfell2009.uk/tick.png) | Not supported ![cross](http://nfell2009.uk/cross.png)

Some of the variable names may differ from spiget-php.php and the list below. This is of no concern if you're just using the API script for normal development. The variable names in the docs here are purely for informative purposes so people can understand what 'type' of variable should be used.

Note: some functions support the custom object types (Resource, ResourceDetails, etc), what each function supports will be listed soon.

### This API supports the following Spiget features (81.82% of the total API supported (18/22)):

#### Resources
Resource List | `getResources($id, [$full = true])`: ![tick](http://nfell2009.uk/tick.png)

Resource Details | `getResourceDetails($resource)`: ![tick](http://nfell2009.uk/tick.png)

Resource Content | `getResourceContent($resource)`: ![tick](http://nfell2009.uk/tick.png)

Resource Description | `getResourceDescription($resource)`: ![tick](http://nfell2009.uk/tick.png)

Resource Download | `downloadResource($resource)`: ![tick](http://nfell2009.uk/tick.png)

Resource Versions | `getResourceVersions($resource, [$version = "latest"])`: ![tick](http://nfell2009.uk/tick.png)

Resource for Version: ![cross](http://nfell2009.uk/cross.png)

Resource Version Download | `downloadResourceForVersion($resource, [$version = "latest"])`: ![tick](http://nfell2009.uk/tick.png)

Resource Author | `getResourceAuthor($resource)`: ![tick](http://nfell2009.uk/tick.png)

New Resources | `getNewResources([$size = 0])`: ![tick](http://nfell2009.uk/tick.png)


#### Resources Categories
Category List | `getResourceCategories()`: ![tick](http://nfell2009.uk/tick.png)

Category Details | `getCategoryDetails($category|$resource)`: ![tick](http://nfell2009.uk/tick.png)

Category Resources | `getCategoryResources($category|$resource)`: ![tick](http://nfell2009.uk/tick.png)


#### Authors
Author List | `getAuthors([$size = 0])`: ![tick](http://nfell2009.uk/tick.png)

Author Details | `getNewResources($author|$resource)`: ![tick](http://nfell2009.uk/tick.png)

Author Resources | `resourcesOfAuthor($author|$resource) OR getResourcesOfAuthor($author|$resource)`: ![tick](http://nfell2009.uk/tick.png)

New Authors | `getNewAuthors([$size = 0])`: ![tick](http://nfell2009.uk/tick.png)


#### Searching
Resource Search | `searchResources($query)`: ![tick](http://nfell2009.uk/tick.png)

Author Search | `searchAuthors($query)`(: ![tick](http://nfell2009.uk/tick.png)


#### Webhooks (not sure how these will be implemented)
Webhook Events: ![cross](http://nfell2009.uk/cross.png)

Register Webhook: ![cross](http://nfell2009.uk/cross.png)

Delete Webhook: ![cross](http://nfell2009.uk/cross.png)

