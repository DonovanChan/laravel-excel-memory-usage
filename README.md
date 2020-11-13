# Laravel Excel Memory Usage

Simple [Laravel](https://laravel.com) 6 application for testing how [Laravel Excel](https://laravel-excel.com) 3.1 utilizes memory.

## Usage

1. Export data to `storage/app/`
    ```
    $ php artisan users:export -c 1000 'test.xlsx'
    ```

2. Import data
    - Add `--batch` flag to use batch reading and inserts
    ```
    $ php artisan users:import storage/app/test.xlsx
    $ php artisan users:import --batch storage/app/test.xlsx
    ```
3. Review results in `storage/logs/memory.log`
4. Optionally graph the csv data in Numbers or Excel
    - I've stored some basic results in `results/`
