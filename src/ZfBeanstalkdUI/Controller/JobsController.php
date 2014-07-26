<?php
namespace ZfBeanstalkdUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pheanstalk\Pheanstalk;

class JobsController extends AbstractActionController
{
    public function indexAction() {}

    public function createAction() {}
    public function readAction() {}
    public function updateAction() {}

    public function kickAction() 
    {
        $tube               =   $this->params()->fromRoute('tube', 'default');
        $id                 =   $this->params()->fromRoute('id');
        
        $count              =   $this->params()->fromRoute('count', 1);

        try {
            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');
            $pheanstalk->useTube($tube)->kick( $count );
        } catch(\Pheanstalk_Exception_ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        } 

        return $this->redirect()->toRoute('zf-beanstalkd/tupe', ['tube' => $tube]);
    }

    public function moveAction() 
    {
        $tube               =   $this->params()->fromRoute('tube', 'default');
        $id                 =   $this->params()->fromRoute('id');
        
        $from               =   $this->params()->fromRoute('from', 'ready');
        $to                 =   $this->params()->fromRoute('to', 'buried');

        try {
            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');

            switch($to) {
                case "buried":
                    $job            =   $pheanstalk->useTube($tube)->reserveFromTube($tube);
                    $pheanstalk->useTube($tube)->bury($job);
                    break;
                case "ready":
                    $pheanstalk->useTube($tube)->kick(1);
                    break;
                default:
                    throw new \Exception('Incorrect Type');
                    break;
            }

        } catch(\Pheanstalk_Exception_ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        } 

        return $this->redirect()->toRoute('zf-beanstalkd/tupe', ['tube' => $tube]);
    }

    public function deleteAction() 
    {
        $tube               =   $this->params()->fromRoute('tube', 'default');
        $id                 =   $this->params()->fromRoute('id');

        try {
            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');

            $job                =   $pheanstalk->useTube($tube)->peek($id);
            $pheanstalk->delete($job);
        } catch(\Pheanstalk_Exception_ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        }

        return $this->redirect()->toRoute('zf-beanstalkd/tupe', ['tube' => $tube]);
    }

    public function searchAction() {}
}
