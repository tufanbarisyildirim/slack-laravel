# Slack for Laravel

This package provides slack support for laravel.
It is similar to [Slack Laravel](https://github.com/markustenghamn/slack-laravel)
but instead of using the deprecated library
[Slack for PHP 1](https://github.com/maknz/slack),
it uses
[Slack for PHP 2](https://github.com/nexylan/slack).
A new developer is leading the project
in a different reposity.


## Install

### Composer stuff


This needs a implementation of the HTTPlug adapter.

```
composer require php-http/guzzle6-adapter
```

And then require this package using
the git repository.
I have not published it into packagist.

```json
"require": {
    
    ...
    "javfres/slack-laravel": "2.0.0",

},

...

"repositories": [
    {
        "type": "git",
        "url": "https://github.com/javfres/laravel-jslang"
    }
]
```

### Webhook


Then [create an incoming webhook](https://my.slack.com/services/new/incoming-webhook) for each the Slack team you'd like to send messages to.

## Laravel

Add the `Javfres\Slack\ServiceProvider` provider to the `providers` array in `config/app.php`:

```php
'providers' => [
    Javfres\Slack\ServiceProvider::class,
],
```

Then add the facade to your `aliases` array:

```php
'aliases' => [
    ...
    'Slack' => Javfres\Slack\Facades\Slack::class,
],
```

Finally, publish the config file with `php artisan vendor:publish`. You will find it at `config/slack.php`.

## Configuration

The config file comes with defaults and placeholders. Configure at least one team and any defaults you'd like to change.




## Extra

Config for using this directly from a folder
instead from github for debug.


```json
"require": {
    
    ...
    "javfres/slack-laravel": "@dev",

},

...

"repositories": [
    {
        "type": "path",
        "url": ".../0_repos/slack-laravel"
    }
]
```