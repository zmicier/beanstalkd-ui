<?php

namespace ZfBeanstalkdUI\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BeanstalkdOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	// Check if the user used already SlmQueueBeanstalkd
    	$isUsingSlmQueue 	=	$serviceLocator->has('SlmQueueBeanstalkd\Options\BeanstalkdOptions');
    	$configKey			=	($isUsingSlmQueue)	?	'slm_queue'		: 	'zf-beanstalkd';

    	$config 			=	isset( $serviceLocator->get('Config')[$configKey] ) ?  $serviceLocator->get('Config')[$configKey]['beanstalkd']	: false;
	    
	    if(!$config)
	    	throw new \Zend\Config\Exception\RuntimeException('Configuration file not found');

        return new \ZfBeanstalkdUI\Options\BeanstalkdOptions(
        	$config
        );
    }
}
