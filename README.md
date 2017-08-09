# Movie-db
Just a simple (and incomplete) rest API.

The main purpose is just to show some OOP principles and a few basic patterns.

## TODO's
- No tests, sorry just ran out of time :( (I usually try and write test as I go).
- It's a read only API at them moment, again just ran out of time.
- Re-read my code a check for any dump mistakes and typos.

## Design Decisions
- I've used some Domain Driven Design principles for this task, it's likely the wrong code style for such a simple app but hopefully it demonstrates how I'd tackle a larger more complex application.
- I decided to use JSON files to persist the movies and actors which is not the greatest but it still lets me to demonstrate a very basic repository pattern. I've used dependency injecting to new up the repo and referenced the repos via their interfaces so these could easily be swapped out for a mongo/redis/sql versions of repos in the future.
- I'm more familiar with Laravel than Slim but I decided to use Slim for 2 reasons, it keeps this code base very light and easy to review, and I've never used it before and it looked fun.
- I've setup docker and docker composer just because I couple of features from php 7.1 and not every one is running it yet.

## Getting it working
Choose if you want to run the app locally (PHP 7.1 is required) or via docker and follow the instructions below.

### Run locally
First install dependencies
```bash
composer install
```
Then
```bash
composer run-script start
```
### Run docker
```bash
docker-compose up -d
```
## Working Routes
```
GET : http://localhost:8080/api/v1/movie
GET : http://localhost:8080/api/v1/movie/1
GET : http://localhost:8080/api/v1/movie/2
GET : http://localhost:8080/api/v1/movie/3
```