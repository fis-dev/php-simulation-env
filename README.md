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
        'level' => Log::ALL & ~Log::DEBUG //not record debug log
    );
    ```

### `mock-data`

mock data

```php
require(ROOT . '/mock-data/Mock.class.php');
Mock::init('<data-dir>', '<encoding>');
$data = Mock::getData('<template-subpath>');
```

- `<data-dir>` the file of mock data root path
- `<encoding>` utf-8 or gbk or ...
- `<template-subpath>` the path of a template file relative to `template_dir`

Map:

|template file| data file|
|:-------------|:-------------|
|`<template_dir>`/home/page/index.tpl| `<data_dir>`/home/page/index.{php|json}|

### `mimetype`

some mimetype

```php
// read the code
```

### `rewrite`

```php
require(ROOT . '/rewrite/Rewrite.class.php');
$rewrite = new Rewrite('<config-base-dir>', '<charset>');

// nice, all static mapping to a dir

$rewrite->addRule(new Rule(Rule::REWRITE, '@/static/*@', 'public/$0'));

// match from top to bottom
$rewrite->addConfigFile('home-server.conf');
$rewrite->addConfigFile('common-server.conf');

// dispatch
$rewrite->dispatch($_SERVER['REQUEST_URI']);
```

- `<config-base-dir>` config files are placed in the dir
- `<charset>` header charset
