# simple_php_restfull_api


### Get routes
`http://localhost/test/public/index.php/api/products/api/products`
- Retrieves all products listed in 'Products' table
- Returns a list of dictinary


`http://localhost/test/public/index.php/api/products/api/product/{id}`
- Retrieves a specific product listed in `Products` table
- Returns a list which contains 1 dictinary 

### Post routes
`http://localhost/test/public/index.php/api/products/api/product/add`
- Send json file to insert a new product into the `Products` table
- Return a json response `Product Added`

### Delete routes
`http://localhost/test/public/index.php/api/products/api/product/delete/{id}`


### Put routes
`http://localhost/test/public/index.php/api/products/api/product/update/{id}`

