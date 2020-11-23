# simple-rss-maker-php

## Contributing

Feel free to submit a Pull Request. However, please run the `make prod` command and check the test content before submitting your Pull Request.

## Development

We recommend using Docker for this project.

## Make Commands

### Initial Setup

```shell script
make setup
```

### Development Test

Testing under development.

```shell script
make test
```

### Code Fixer

```shell script
make fix
```

### Production Test

Test before you Pull Request.

```shell script
make prod
```

## How to use

For Example.

```php
$simpleRssMaker = new SimpleRssMaker();

$xml = $simpleRssMaker
    // Channel settings.
    ->setChannel('title', 'link', 'description', 'language', 'copyright', 'category', 'pubDate')
    // Image settings.
    ->setImage('title', 'link', 'url')
    // Item settings.
    ->addItem('title', 'link', 'description', 'author', 'category', 'datetime')
    ->addItem('title', 'link')
    // Generate RSS2.0 string.
    ->rss2();

// If you have more than one article.
$simpleRssMaker = $simpleRssMaker
    // Channel settings.
    ->setChannel('title', 'link', 'description', 'language', 'copyright', 'category', 'pubDate')
    // Image settings.
    ->setImage('title', 'link', 'url');

foreach($items as $item) {
    $simpleRssMaker = $simpleRssMaker
        ->addItem('title', 'link', 'description', 'author', 'category', 'datetime');
}

// Generate RSS2.0 string.
$xml = $simpleRssMaker->rss2();
```
