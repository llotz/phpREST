# phpREST
This is a leightweight API written in plain PHP. It's held simple and highly extensible.
There is an __API__ and a __RestClient__, both used to process simple REST calls.

## Features API
- Request Method differentiation
- __Basic Auth__ for endpoints 
  - different credentials for each endpoint
- Fast implementation of endpoints by extending base API class
- Request body processing


## Features RestClient
- Request Method defining
- __Basic Auth__
- JSON body submitting
- Support for multiple endpoints from single instance

## How to run?

clone repo, cd to repo and run
> docker-compose up

## How to test?

>localhost

will take you to the RestClientFrontend
this form, when submitted, will make an API call to the backend service and show the results.

>localhost:3000

will take you to the API endpoint overview

>localhost:3000/api/test

will give you a json example of an endpoint answer

>localhost:3000/api/persons

will give you a 403 response cause this endpoint requires basic user auth
