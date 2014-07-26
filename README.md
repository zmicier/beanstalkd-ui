## Beanstalkd Admin UI
### Intro
A simple Beanstalkd Admin UI to get information about your jobs, it is not required to have [SlmQueue](https://github.com/juriansluiman/SlmQueue)/[SlmQueueBeanstalkd](https://github.com/juriansluiman/SlmQueueBeanstalkd) installed, but to fire jobs it's required. 

This is only a shell/ui to get information about your jobs. 
### Install
#### Installation with the composer
```sh
php composer.phar require nickurt/beanstalkd-ui:dev-master
```

### Requirements

* [Zend Framework 2.3.*](https://github.com/zendframework/zf2)
* [Pda Pheanstalk](https://github.com/pda/pheanstalk)
* [SlmQueue](https://github.com/juriansluiman/SlmQueue) (optional)
* [SlmQueueBeanstalkd](https://github.com/juriansluiman/SlmQueueBeanstalkd) (optional)

### Post Installation

Enable it in your `application.config.php` file
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
### Configuration
#### Config
When you are already using [SlmQueue](https://github.com/juriansluiman/SlmQueue)/[SlmQueueBeanstalkd](https://github.com/juriansluiman/SlmQueueBeanstalkd), it is not needed to copy any configuration files.

ZfBeanstalkdUI will automatic detect your configuration settings, due it used the same connection service/files as SlmQueueBeanstalkd. 

When you are not using this, copy the file (remove the *.dist) `config/zfbeanstalkd_config.local.php.dist` to your `config/autoload` folder and change the configuration settings.
#### Routes
Yes!, it is possible to change the routes of the application, just copy (remove the *.dist) the `config/zfbeanstalkd_routes.local.php.dist` file to your `config/autoload` folder and change the settings.
### Examples
![Example2](https://raw.githubusercontent.com/nickurt/beanstalkd-ui/master/examples/example2.png)
![Example1](https://raw.githubusercontent.com/nickurt/beanstalkd-ui/master/examples/example1.png)
