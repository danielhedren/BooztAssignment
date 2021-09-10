# MVC Assignment

## Setup
Set the environment variable `DB_CONNECTION_STRING` to something along the lines of `mysql:host=localhost;user=;password=;dbname=;`.

Apply the migrations to the database with `mysql dbname < Migrations/1_CreateSchema_up.sql` and so on.

## Launching
Assuming the `symfony` command is installed, run `symfony server:start` in the root directory.

## First run
Click the `Generate order data` button to insert 10-20 rows of demonstration order data into the database per click.

## Known issues
* There are no tests
* There is only very basic error handling
* The application is not containerized
* The route parameter matching is not finished, as it was not required to finish the assignment
* The views do not use a base template with something like blocks
* Link routes are hardcoded instead of letting the router create paths
* Code reuse could be much improved in e.g. OrderRepository
* The from and to dates are not sanity checked for e.g. from < to
* Order data has to be generated manually by clicking the button
