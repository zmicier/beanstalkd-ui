<?php
return array(
    'router' => array(
        'routes' => array(
            'zf-beanstalkd' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/beanstalkd',
                    'defaults' => array(
                        'controller' => 'ZfBeanstalkdUI\Controller\Dashboard',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'tupe' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'    => '/[:tube]',
                            'constraints' => array(
                                'tube'  =>  '[a-z0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'ZfBeanstalkdUI\Controller\Dashboard',
                                'action'     => 'tube',
                            ),
                        ),
                    ),
                    'tupe-jobs-delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'    => '/[:tube]/jobs/[:id]/delete',
                            'constraints' => array(
                                'tube'  =>  '[a-z0-9]+',
                                'id'    =>  '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ZfBeanstalkdUI\Controller\Dashboard'   =>  'ZfBeanstalkdUI\Controller\DashboardController',
            'ZfBeanstalkdUI\Controller\Jobs'        =>  'ZfBeanstalkdUI\Controller\JobsController'
        ),
    ), 
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'ZfBeanstalkdUI\Options\BeanstalkdOptions' => 'ZfBeanstalkdUI\Factory\BeanstalkdOptionsFactory',
            'ZfBeanstalkdUI\Service\PheanstalkService' => 'ZfBeanstalkdUI\Factory\PheanstalkFactory',
        )
    )
);
