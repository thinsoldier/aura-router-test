<p><a href="/blog/44?cmd=view&similar=1"> test url - click me </a></p>
<?
error_reporting(E_ALL);

include 'vendor/autoload.php';

use Aura\Router\RouterContainer;

$routerContainer = new RouterContainer(); #var_dump($routerContainer);

$map = $routerContainer->getMap();

$map->get('blog.read', '/blog/{id}', function ($request, $response) {
    $id = (int) $request->getAttribute('id');
    $response->body()->write("You asked for blog entry {$id}.");
    return $response;
});

$matcher = $routerContainer->getMatcher();

$request = \Zend\Diactoros\ServerRequestFactory::fromGlobals(); #var_dump($request);

$route = $matcher->match($request);

if( false === $route ){ echo "route not found for current url"; }

var_dump($route);

#var_dump($route->attributes);

#var_dump($_GET);

foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

#var_dump($request);

$callable = $route->handler;
$response = $callable($request);

?>

