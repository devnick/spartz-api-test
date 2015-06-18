# Spartz REST API coding exercize

## System requirements

1. Vagrant 1.6+

## Installation instructions

1. clone this repo locally
2. in the application root, run 'vagrant up && vagrant ssh'
4. 'cd /var/www && composer install && php artisan migrate --seed'
5. access the application at 192.168.33.91

## API Endpoints

### States

Get a paginated list of states

    `GET /states?page=x`

Get a state by ID

    `GET /states/{stateId}`

Get a city by state and allow for inclusion of nearby locations, controlled by the radius parameter, and page through the nearby collection using the limit parameter (limit|offset)

    `GET /states/{stateId}/cities/{cityId}?include=nearby:radius(100):limit(10|0)`

### Cities

Get a paginated list of cities

    `GET /cities?page=x`

Get a city by ID

    `GET /cities/{cityId}?include=nearby:radius(100):limit(10|0)`

### Users

Get a paginated list of users

    `GET /users?page=x`

Get a user by ID

    `GET /users/{userId}`

Get a list of visited cities by user

    `GET /users/{userId}/visits?page=x`

Mark a city as visited by the user

    `POST /users/{userId}/visits?city=xxxxx&state=xxxxx`

### Application design rationale

1. From the readme, the suggested endpoints are prefixed with /v1/ for versioning. This is a bad practice and versioning should be controlled from content negotiation using the Application header on incoming requests. The URI is the bedrock of the API and should not change to avoid breaking changes in client applications. Conforming to HATEOAS principles and allowing for header version requests is a cleaner, more scalable method for versioning, and thus I have ommitted it from the endpoints for this exercize as a demonstration of best practises.

2. For accessing nearby cities based on a defines radius, having a listing of related cities at the endpoint /states/{stateId}/cities/{cityId}?radius=100 (as in the readme's suggestion) does not conform strictly to RESTful concepts. The primary endpoint request here is for a single resource (a city), so I have elected to instead make the request more flexible by allowing for inclusion of an 'include' parameter that can specify to include nearby locations selectively, the ability to specify a radius up to 100 miles, and the ability to limit the nested paged results (they can be a large subset of data) with the limit(limit|offset) parameter.

3. The detailed database schema can be reviewed in the files under database/migrations
