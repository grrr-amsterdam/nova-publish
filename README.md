# Nova publish

<!-- Header & Preview Image -->
<h1 align="center">
  <img src=".github/readme-hero.png">
</h1>

<!-- Shields -->

<!-- Description -->

> Adds a publish button to Nova to trigger a Github workflow which runs you static site generator

## Table of Contents

-   [Table of Contents](#table-of-contents)
-   [Requirements](#requirements)
-   [Installation](#installation)

## Requirements

[Return To Top](#nova-publish)

-   PHP 7.1
-   Github workflow

## Installation

[Return To Top](#nova-publish)

Install package

```shell script
composer require grrr/nova-publish
php artisan p
```
```php
# NovaServiceProvider.php

use Publish\Publish;

...

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<Tool>
     */
    public function tools()
    {
        return [new Publish()];
    }

...
```
