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
                    'tube' => array(
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
                    'tube-jobs-create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'    => '/[:tube]/jobs/create',
                            'constraints' => array(
                                'tube'  =>  '[a-z0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'tube-jobs-delete' => array(
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
                    'tube-jobs-move' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'    => '/[:tube]/jobs/[:id]/move/[:from]/[:to]',
                            'constraints' => array(
                                'tube'  =>  '[a-z0-9]+',
                                'id'    =>  '[0-9]+',
                                'from'  =>  '(ready)',
                                'to'    =>  '(buried)',
                            ),
                            'defaults' => array(
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'move',
                            ),
                        ),
                    ),
                    'tube-jobs-kick' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'    => '/[:tube]/jobs/[:count]/kick',
                            'constraints' => array(
                                'tube'  =>  '[a-z0-9]+',
                                'count' =>  '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'kick',
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
    ),
    'navigation' => array(
        'default' => array(
            'zf-beanstalkd' =>  array(
                'label'     =>  'Beanstalkd',
                'route'     =>  'zf-beanstalkd',
                'pages'     =>  array(
                    array(
                        'label'     =>  '[:tube]',
                        'route'     =>  'zf-beanstalkd/tube',
                        'pages'     =>  array(
                            array(
                                'label'     =>  'Create job',
                                'route'     =>  'zf-beanstalkd/tube-jobs-create'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
