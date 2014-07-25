<?php

namespace ZfBeanstalkdUI\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BeanstalkdOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \ZfBeanstalkdUI\Options\BeanstalkdOptions(
        	$serviceLocator->get('Config')['slm_queue']['beanstalkd']
        );
    }
}
