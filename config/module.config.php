<?php
return [
    'router' => [
        'routes' => [
            'zf-beanstalkd' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/beanstalkd',
                    'defaults' => [
                        'controller' => 'ZfBeanstalkdUI\Controller\Dashboard',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'tube' => [
                        'type' => 'Segment',
                        'options' => [
                            'route'    => '/[:tube]',
                            'constraints' => [
                                'tube'  =>  '[a-z0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'ZfBeanstalkdUI\Controller\Dashboard',
                                'action'     => 'tube',
                            ],
                        ],
                    ],
                    'tube-jobs-create' => [
                        'type' => 'Segment',
                        'options' => [
                            'route'    => '/[:tube]/jobs/create',
                            'constraints' => [
                                'tube'  =>  '[a-z0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'create',
                            ],
                        ],
                    ],
                    'tube-jobs-delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route'    => '/[:tube]/jobs/[:id]/delete',
                            'constraints' => [
                                'tube'  =>  '[a-z0-9]+',
                                'id'    =>  '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                    'tube-jobs-move' => [
                        'type' => 'Segment',
                        'options' => [
                            'route'    => '/[:tube]/jobs/[:id]/move/[:from]/[:to]',
                            'constraints' => [
                                'tube'  =>  '[a-z0-9]+',
                                'id'    =>  '[0-9]+',
                                'from'  =>  '(ready)',
                                'to'    =>  '(buried)',
                            ],
                            'defaults' => [
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'move',
                            ],
                        ],
                    ],
                    'tube-jobs-kick' => [
                        'type' => 'Segment',
                        'options' => [
                            'route'    => '/[:tube]/jobs/[:count]/kick',
                            'constraints' => [
                                'tube'  =>  '[a-z0-9]+',
                                'count' =>  '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'ZfBeanstalkdUI\Controller\Jobs',
                                'action'     => 'kick',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'ZfBeanstalkdUI\Controller\Dashboard'   =>  'ZfBeanstalkdUI\Controller\DashboardController',
            'ZfBeanstalkdUI\Controller\Jobs'        =>  'ZfBeanstalkdUI\Controller\JobsController'
        ],
    ], 
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'ZfBeanstalkdUI\Options\BeanstalkdOptions' => 'ZfBeanstalkdUI\Factory\BeanstalkdOptionsFactory',
            'ZfBeanstalkdUI\Service\PheanstalkService' => 'ZfBeanstalkdUI\Factory\PheanstalkFactory',
        ]
    ],
    'navigation' => [
        'default' => [
            'zf-beanstalkd' =>  [
                'label'     =>  'Beanstalkd',
                'route'     =>  'zf-beanstalkd',
                'pages'     =>  [
                    [
                        'label'     =>  '[:tube]',
                        'route'     =>  'zf-beanstalkd/tube',
                        'pages'     =>  [
                            [
                                'label'     =>  'Create job',
                                'route'     =>  'zf-beanstalkd/tube-jobs-create'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
