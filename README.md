# phpREST
This is a leightweight API written in plain PHP. It's held simple and highly extensible.
There is an __API__ and an __RestClient__, both used to do simple calls.

## Features API
- Request Method differentiation
- Basic Auth for endpoints 
  - different credentials for each endpoint
- Fast implementation of endpoints by extending base API class


## Features RestClient
- Request Method defining
- Basic Auth
- JSON body sending
- Support for multiple endpoints

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

will give you a 403 response cause this endpoint requires user validation