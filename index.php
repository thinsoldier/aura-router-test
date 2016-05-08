<?
error_reporting(E_ALL);
include 'vendor/autoload.php';


use Aura\Router\RouterContainer;

$routerContainer = new RouterContainer();
//var_dump($routerContainer);


$map = $routerContainer->getMap();


$map->get('blog.read', '/blog/{id}', function ($request, $response) {
    $id = (int) $request->getAttribute('id');
    $response->body()->write("You asked for blog entry {$id}.");
    return $response;
});


$matcher = $routerContainer->getMatcher();

$request = (object)[]; // I have no idea what to put in the $request variable.

$route = $matcher->match($request);

foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}
?>