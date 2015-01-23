# php-simulation-env
Simulation env for fis-plus

## global constant

- `ROOT`

    ```php
    define('ROOT', dirname(__DIR__));
    ```

- `WWW_ROOT` web document root path

    ```php
    define('ROOT', dirname(__DIR__));
    ```

## Component

all component depends on `log`


brefore init

```php
require(ROOT . '/log/Log.class.php');
Log::getLogger(array(
    'fd' => '<to log file>',
    'level' => Log::ALL
));
```

### `log`

```php
require(ROOT . '/log/Log.class.php');
Log::getLogger(array(
    'fd' => '<to log file>',
    'level' => Log::ALL
));
```

Options:

- `fd` given a log file path
- `level` it same the level of `error_reporting` in PHP
    - `Log::ALL`  all log
    - `Log::DEBUG` debug
    - `Log::INFO`  info
    - `Log::WARN`  warning
    - `Log::ERROR` error

    ```php
    array(
        'level' => Log::ALL & ~LOG::DEBUG //not record debug log
    );
    ```

### `mock-data`

### `rewrite`
