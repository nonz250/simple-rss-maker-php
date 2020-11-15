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

// Get channel object for channel tag.
$channel = $simpleRssMaker->channelFactory();

// Set values to channel.
$channel->setCopyright('©nonz250');

// Set channel to simpleRssMaker.
$simpleRssMaker->setChannel($channel);

// Generate RSS2.0 string.
$xml = $simpleRssMaker->rss2();
```
