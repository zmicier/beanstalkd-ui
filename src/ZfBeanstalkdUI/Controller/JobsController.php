<?php
namespace ZfBeanstalkdUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pheanstalk\Pheanstalk;
use Pheanstalk\Exception as PheanstalkException;

class JobsController extends AbstractActionController
{
    public function indexAction() {}

    public function createAction() 
    {
        try {
            $tube               =   $this->params()->fromRoute('tube', 'default');

            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');
            $pheanstalk->statsTube($tube);
        } catch(PheanstalkException\ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        } 

        // Form
        $form               =   new \ZfBeanstalkdUI\Form\Jobs\CreateForm();

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            
            $profile            =   new \ZfBeanstalkdUI\Form\Jobs\Create();
            $form->setInputFilter($profile->getInputFilter());
            
            // Check if the Form is valid
            if($form->isValid()) {
                try {                    
                    // Insert a new job
                    $pheanstalk->useTube($tube)->put(
                        $this->getRequest()->getPost('data'), 
                        $this->getRequest()->getPost('priority'), 
                        $this->getRequest()->getPost('delay'), 
                        $this->getRequest()->getPost('ttr')
                    );
                } catch(PheanstalkException\ServerException $e) {
                    $this->getResponse()->setStatusCode(404); return; 
                } 

                return $this->redirect()->toRoute('zf-beanstalkd/tube', ['tube' => $tube]);
            }
        }

        return new ViewModel(['form' => $form, 'tube' => $tube]);
    }

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
        } catch(PheanstalkException\ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        } 

        return $this->redirect()->toRoute('zf-beanstalkd/tube', ['tube' => $tube]);
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

        } catch(PheanstalkException\ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        } 

        return $this->redirect()->toRoute('zf-beanstalkd/tube', ['tube' => $tube]);
    }

    public function deleteAction() 
    {
        $tube               =   $this->params()->fromRoute('tube', 'default');
        $id                 =   $this->params()->fromRoute('id');

        try {
            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');

            $job                =   $pheanstalk->useTube($tube)->peek($id);
            $pheanstalk->delete($job);
        } catch(PheanstalkException\ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        }

        return $this->redirect()->toRoute('zf-beanstalkd/tube', ['tube' => $tube]);
    }

    public function pauseAction() 
    {
        try {
            $tube               =   $this->params()->fromRoute('tube', 'default');

            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');
            $pheanstalk->pauseTube($tube, 3600);
        } catch(PheanstalkException\ServerException $e) {
            $this->getResponse()->setStatusCode(404); return; 
        } 

        return $this->redirect()->toRoute('zf-beanstalkd/tube', ['tube' => $tube]);
    }

    public function searchAction() {}
}
