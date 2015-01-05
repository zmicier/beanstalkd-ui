<?php

namespace ZfBeanstalkdUI\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Pheanstalk\Pheanstalk;

class PheanstalkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $beanstalkdOptions = $serviceLocator->get('ZfBeanstalkdUI\Options\BeanstalkdOptions');
        $connectionOptions = $beanstalkdOptions->getConnection();

        return new Pheanstalk(
            $connectionOptions->getHost(),
            $connectionOptions->getPort(),
            $connectionOptions->getTimeout()
        );
    }
}
