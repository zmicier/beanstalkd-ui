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

        return $this->redirect()->toRoute('zf-beanstalkd-tupe', ['tube' => $tube]);
    }

    public function searchAction() {}
}
