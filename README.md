# simple_php_restfull_api
This api was created to be able to manage a simple database. It offers people an inside look how the backend of a small ecommerce site might work. Slim 

Slim Framework was choosen because it is a micro framework that allows developers quickly and easily write APIs




## How this api works
- This api operates by only using 3 simple steps:
    - First, the user send a request with the required parameters to the server
    - Second, the api process the request and take the appropiate action for `[post, put, delete, get]`
    - Third, return a coresponding json response stating the action has completed
    

## Structure Layout
```
.
├── composer.json
├── vendor
├── public
│   ├── index.php
│   └── test.html
├── README.md
└── src
    ├── config
    │   └── db.php
    └── routes
        └── products.php
```




## Setting up MySQL server

```
CREATE DATABASE test;

CREATE USER read_user@localhost
IDENTIFIED BY PASSWORD '*P2UDFJWmI4VbjnOB';

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

This is a very simple ER Diagram to make it easier to understand the database relationship with other tables. But in our case there is only one table.
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

## Future improvement
Future improvement I would love to remake the `test.html` into a vue js application, but for now. I kept it simple due to time constraints. The other thing I really wish I did was set up a configuration file for the server.
