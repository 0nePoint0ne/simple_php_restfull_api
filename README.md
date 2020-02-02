# simple_php_restfull_api


## Setting up MySQL server
```
CREATE TABLE Products(
    price INT,
    stock INT,
    id VARCHAR(60),
    title VARCHAR(255),
    description VARCHAR(1000),
    status VARCHAR(25),
    PRIMARY KEY(id)
);
```
### ER Diagram

This is a very simple ER Diagram
```
///////////////////////////////
/      Products               /     
///////////////////////////////
/      id              (PK)   /
/      price                  /
/      title                  /
/      description            /
/      stock                  /
/      status                 /
///////////////////////////////
```

## Setting API up
- `cd /opt/lampp/htdocs`
- `git clone https://github.com/0nePoint0ne/simple_php_restfull_api.git`
- `mv simple_php_restfull_api test`
- `/opt/lampp/lampp start`

## Testing API
A file called `test.html` can be used to test the api. Simply use the route bellow with the following object



## Routes for API
Bellow are route that are available from the api. Each route is listed with parameters

### Get routes
`http://localhost/test/public/index.php/api/products/api/products`
- Retrieves all products listed in 'Products' table
- Returns a list of dictinary


`http://localhost/test/public/index.php/api/products/api/product/{id}`
- Retrieves a specific product listed in `Products` table
- Returns a list which contains 1 dictinary 
- Testing application in the above url insert value for `id`

### Post routes
`http://localhost/test/public/index.php/api/products/api/product/add`
- Send json request to insert a new product into the `Products` table
- Return a json response `Product Added`
- Testing application when using the above url also use the following object:
```
{
  "id": "1",
  "price": 10,
  "title": "Test",
  "description": "Test Item",
  "stock": 2,
  "status": "Available"
}
```


### Delete routes
`http://localhost/test/public/index.php/api/products/api/product/delete/{id}`
- Send json request to delete a product into the `Products` table
- Return a json response `{"notice": {"text": "Product Deleted"}`
- Testing application in the above url insert value for `id`


### Put routes
`http://localhost/test/public/index.php/api/products/api/product/update/{id}`
- Send json file to update a product into the `Products` table.
- Return a json response `{"notice": {"text": "Product Updated"}`
- Testing application when using the above url also use the following object:
```
{
  "id": "1",
  "price": 10,
  "title": "Test",
  "description": "Test Item",
  "stock": 0,
  "status": "Out of Stock"
}
```

