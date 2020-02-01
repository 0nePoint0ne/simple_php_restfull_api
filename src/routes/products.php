<?php
use \Psr\Http\Message\ServerRequestInterface as Request; 
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/api/products', function (Request $request, Response $response) {
    $sql = "SELECT * FROM Products";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($products);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


$app->post('/api/product/add', function(Request $request, Response $response){
    $price = $request->getAttribute('price');
    $id = $request->getParam('id');
    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $available = $request->getParam('available');
    $status = $request->getParam('status');

    $sql = "INSERT INTO Products (price,id,title,description,available,status) VALUES (:price,:id,:title,:description,:available,:status)";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id',  $id);
        $stmt->bindParam(':title',      $title);
        $stmt->bindParam(':description',      $description); 
        $stmt->bindParam(':available',    $available);
        $stmt->bindParam(':status',       $status);

        $stmt->execute();

        echo '{"notice": {"text": "Product Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

