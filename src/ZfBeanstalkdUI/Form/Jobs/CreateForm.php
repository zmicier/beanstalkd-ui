<?php
namespace ZfBeanstalkdUI\Form\Jobs;

class CreateForm extends \Zend\Form\Form
{
    public function __construct()
    {    	
    	parent::__construct('create');
        $this->setAttribute('method', 'post');
        
        $this->add([
            'name' => 'data',
            'attributes' => [
                'type'  		=> 	'textarea',
            	'class'			=> 	'form-control',
				'placeholder' 	=> 	'MyJob',
            	'id'			=>	'data',
            	'required'   	=> 	true,
                'rows'          =>  6,
            ],
            'options' => [
                'label' 		=> 	'Data',
            	'errorClass'	=> 	'list-unstyled alert alert-danger'	
            ],   
        ]);

        $this->add([
            'name' => 'priority',
            'attributes' => [
                'type'          =>  'number',
                'class'         =>  'form-control',
                'placeholder'   =>  '1024',
                'value'         =>  '1024',
                'id'            =>  'priority',
                'required'      =>  true,
            ],
            'options' => [
                'label'         =>  'Priority',
                'errorClass'    =>  'list-unstyled alert alert-danger'  
            ],  
        ]);

        $this->add([
            'name' => 'delay',
            'attributes' => [
                'type'          =>  'number',
                'class'         =>  'form-control',
                'placeholder'   =>  '0',
                'value'         =>  '0',
                'id'            =>  'delay',
                'required'      =>  true,
            ],
            'options' => [
                'label'         =>  'Delay',
                'errorClass'    =>  'list-unstyled alert alert-danger'  
            ],
        ]);

        $this->add([
            'name' => 'ttr',
            'attributes' => [
                'type'          =>  'number',
                'class'         =>  'form-control',
                'placeholder'   =>  '60',
                'value'         =>  '60',
                'id'            =>  'ttr',
                'required'      =>  true,
            ],
            'options' => [
                'label'         =>  'Time to run',
                'errorClass'    =>  'list-unstyled alert alert-danger'  
            ],
        ]);
        
       	$this->add([
	   		'type' => 'Zend\Form\Element\Csrf',
		    'name' => 'token',
		    'options' => [
		        'csrf_options' => [
		            'timeout' => 600
		        ]
		    ]
		]);
        
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type'  	=> 'submit',
                'value' 	=> 'Save',
                'id' 		=> 'submit',
            	'class'		=> 'btn btn-success',
            ],
        ]);
    }
}