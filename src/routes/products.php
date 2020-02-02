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
//this function get all the product in the database
$app->get('/api/products', function (Request $request, Response $response) {
    $sql = "SELECT * FROM Products";
    try{
        //create a database object
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

$app->get('/api/product/{id}', function (Request $request, Response $response) {
    //Get id data from url
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM Products WHERE id = $id";
    try{
        //create a database object
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
    //Get data from json
    $price = $request->getParam('price');
    $id = $request->getParam('id');
    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $stock = $request->getParam('stock');
    $status = $request->getParam('status');

    $sql = "INSERT INTO Products (price,id,title,description,stock,status) VALUES (:price,:id,:title,:description,:stock,:status)";

    try{
        //create a database object
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id',  $id);
        $stmt->bindParam(':title',      $title);
        $stmt->bindParam(':description',      $description); 
        $stmt->bindParam(':stock',    $stock);
        $stmt->bindParam(':status',       $status);

        $stmt->execute();

        echo '{"notice": {"text": "Product Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->delete('/api/product/delete/{id}', function(Request $request, Response $response){
    //Get id data from url
    $id = $request->getAttribute('id');
    

    $sql = "DELETE FROM Products WHERE id = $id";

    try{
        //create a database object
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Product Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->put('/api/product/update/{id}', function(Request $request, Response $response){
    //Get id data from url
    $id = $request->getAttribute('id');
    //Get data from json
    $price = $request->getParam('price');
    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $stock = $request->getParam('stock');
    $status = $request->getParam('status');


    $sql = "UPDATE Products SET
				price 	= :price,
                title		= :title,
                description		= :description,
                stock 	= :stock,
                status 		= :status
			WHERE id = $id";

    try{
        //create a database object
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':title',      $title);
        $stmt->bindParam(':description',      $description); 
        $stmt->bindParam(':stock',    $stock);
        $stmt->bindParam(':status',       $status);

        $stmt->execute();

        echo '{"notice": {"text": "Product Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

