# Victor's Petstore

Simple pet store written in PHP.

I tried to keep it reusable as much as possible.
There is Core\Base functionality available to use for other projects.

The project structure is follows:
```
-data //Data fixtures. A real DB was not used.
-test
-src
 -- Adapters // contains adapters to the framework functionality
 -- Framework // it is oversimplified and it was built just for the task
 -- App // it is application layer. Please find use cases there.
 -- Core // it is Domain layer that implements domain api.
```

## Instalation and Usage

To install just run `composer install`

The only console version is available.
To run program simply use `php index.php`

The following commands are available:

* php index.php revenue: Show petstore revenue report
* php index.php showroom: Show pets that should be in the showroom


To run tests please use `composer test` command.


## Requirements
PHP 7.2 or above

## License
[MIT](https://choosealicense.com/licenses/mit/)

