## Beanstalkd Admin UI

### Install
Installation with the composer
```sh
php composer.phar require nickurt/beanstalkd-ui:dev-master
```

### Requirements

* [Zend Framework 2.3.*](https://github.com/zendframework/zf2)
* [Pda Pheanstalk](https://github.com/pda/pheanstalk)
* [SlmQueue](https://github.com/juriansluiman/SlmQueue) (optional)
* [SlmQueueBeanstalkd](https://github.com/juriansluiman/SlmQueueBeanstalkd) (optional)

### Post Installation

Enabling it in your `application.config.php` file
```php
<?php
return array(
    'modules' => array(
        // ...
        'ZfBeanstalkdUI',
    ),
    // ...
);
```

### Examples

![Example1](https://raw.githubusercontent.com/nickurt/beanstalkd-ui/master/examples/example1.png)
![Example2](https://raw.githubusercontent.com/nickurt/beanstalkd-ui/master/examples/example2.png)
