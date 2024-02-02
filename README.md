[![License: MIT](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)

# Exads test
Candidate challenge for PHP Developer position at Exads.
Check how you can access the [challenges](#challenges) here.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installation

#### Install Using Docker Compose
##### Prerequisites
- [Docker](https://docs.docker.com/engine/install/)
- [Docker Compose](https://docs.docker.com/compose/install/)

##### Docker Environment

- PHP v8.3.2
- Nginx Latest
- MySQL v8.3.0


Build the containers:

```BASH
docker compose build
```

Execute:

```BASH
docker compose up -d && docker compose exec php-service composer install
```

If you prefer, you could run just one command, to build and execute:

```BASH
docker compose up --build -d && docker compose exec php-service composer install
```

Execute:

```BASH
docker compose exec php-service composer dump-autoload --optimize 
```

## Challenges
### 1. Prime Numbers
Write a PHP script that prints all integer values from 1 to 100.

Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
only multiple of itself then print “[PRIME]”.

#### Execute

```BASH
docker compose run php-service php bin/console.php app:prime [] []
```

| argument    | type    | description              | mandatory | default |
| ----------- | ------- | ------------------------ | --------- | ------- |
| firstNumber | integer | First number of the list | no        | 1       |
| lastNumber  | integer | Last number of the list  | no        | 100     |

### 2. ASCII Array
Write a PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.

Write the code to efficiently determine the missing character.

#### Execute

```BASH
 docker compose run php-service php bin/console.php app:ascii-array [startChar] [lastChar]
```

| argument    | type    | description                 | mandatory | default |
| ----------- | ------- | --------------------------- | --------- | ------- |
| firstNumber | string  | First Character in the list | no        | ','     |
| lastNumber  | string  | Last Character in the list  | no        | '\|'    |

### 3. TV Series
Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:

`tv_series -> (id, title, channel, gender);`

`tv_series_intervals -> (id_tv_series, week_day, show_time);`

* Provide the SQL scripts that create and populate the DB;

Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
inputted time-date, and that can be optionally filtered by TV Series title.

##### Execute (After run up docker containers)

[http://localhost:8080/series](http://localhost:8080/series)

### 4. A/B Testing
Exads would like to A/B test some promotional designs to see which provides the best conversion rate.
Write a snippet of PHP code that redirects end users to the different designs based on the data
provided by this library: [packagist.org/exads/ab-test-data](https://packagist.org/packages/exads/ab-test-data)

#### Execute (After run up docker containers)

[http://localhost:8080/abtest](http://localhost:8080/abtest)

### Running Tests

```BASH
docker compose run composer test
```

### Coverage Report

```BASH
docker compose run composer coverage-report        # See the report in tests/coverage/reports/index.html
```

### Code Sniffer Linter

```BASH
docker compose exec php-service composer phpcs          # Detect coding standards violations (PSR-1, PSR-2, PSR-12)
docker compose exec php-service composer phpcbf                  # Try to automatically correct this coding standard violations
```

### Static Analyser

```BASH
docker compose exec php-service composer phpstan          # Run static analyser
```

### PS.:To run the application, port 8080 on localhost (127.0.0.1) must be free.
