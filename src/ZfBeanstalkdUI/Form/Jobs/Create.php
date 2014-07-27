<?php
namespace ZfBeanstalkdUI\Form\Jobs;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
 
class Create implements InputFilterAwareInterface
{
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
     
    public function getInputFilter()
    {
      $inputFilter = new InputFilter();
      $factory     = new InputFactory();
              
      $inputFilter->add(
        $factory->createInput([
          'name'      =>  'data',
          'required'  =>  true,                  
          'filters'   =>  [
            ['name'     => 'StripTags'],
            ['name'     => 'StringTrim'],
          ],
          'validators' => [
            [
              'name'    => 'StringLength',
              'options' => ['min' => 2, 'max' => 65536],
            ],
          ],
        ]
      ));

      $inputFilter->add(
        $factory->createInput([
          'name'      =>  'priority',
          'required'  =>  true,                   
          'filters'   =>  [
            ['name'     => 'StripTags'],
            ['name'     => 'StringTrim'],
          ],
          'validators' => [
            [
              'name'    => 'Between',
              'options' => ['min' => 0, 'max' => 4294967295],
            ],
          ],
        ]
      ));

      $inputFilter->add(
        $factory->createInput([
          'name'      =>  'delay',
          'required'  =>  true,                   
          'filters'   =>  [
            ['name'     => 'StripTags'],
            ['name'     => 'StringTrim'],
          ],
          'validators' => [
            [
              'name'    => 'Between',
              'options' => ['min' => 0, 'max' => 172800],
            ],
          ],
        ]
      ));

      $inputFilter->add(
        $factory->createInput([
          'name'      =>  'ttr',
          'required'  =>  true,                   
          'filters'   =>  [
            ['name'     => 'StripTags'],
            ['name'     => 'StringTrim'],
          ],
          'validators' => [
            [
              'name'    => 'Between',
              'options' => ['min' => 0, 'max' => 172800],
            ],
          ],
        ]
      ));
             
     	return $inputFilter;
    }
}