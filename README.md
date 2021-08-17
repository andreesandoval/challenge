This project has been built in PHP with the Lumen Framework.

To make it work there are some requirements:

```
- PHP >= 7.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Composer
```

And to start the server it is necessary to run these commands:

```
- cp .env.example .env
- composer install
- php -S localhost:8000 -t public
```

---
I decided to work with SQLite because it allows me to attach the database to the project as a file, so it is ready to go. The database.sqlite file can be found in the database directory. It has some products and users already registered.

---

This has 3 endpoints to play with in a tool like Postman:

1.- List the recently viewed products by user: 

```
method: GET

endpoint: http://localhost:8000/users/{userId}/recently-viewed

test cases:
user with products: http://localhost:8000/users/1/recently-viewed
user without products (fallback): http://localhost:8000/users/30/recently-viewed
```

2.- Save a recently viewed product for a user (create and update): 

```
method: POST

endpoint: http://localhost:8000/users/{userId}/recently-viewed

headers:
Content-Type: application/json
Accept: application/json

body:
{
    "product_id": {productId}
}
```

3.- Delete a specific recently viewed product by userId and productId: 

```
method: DELETE

endpoint: http://localhost:8000/users/{userId}/recently-viewed/{productId}
```

---

Important Note: When a new recently viewed product is assigned to a user an event is fired to check if the limit of 100 items has been reached to delete the items that we don't need anymore.