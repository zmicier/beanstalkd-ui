<?php
namespace ZfBeanstalkdUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pheanstalk\Pheanstalk;

class DashboardController extends AbstractActionController
{
    public function indexAction()
    {
        $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');
        $tubes              =   $pheanstalk->listTubes();

        $stats              =   array();

        foreach($tubes as $tube) {
            $stats[]        =      $pheanstalk->statsTube($tube);
        }

        return new ViewModel(array(
            'stats'         =>  $stats
        ));
    }

    public function tubeAction() 
    {
        try {
            $tube               =   $this->params()->fromRoute('tube', 'default');

            $pheanstalk         =   $this->getServiceLocator()->get('ZfBeanstalkdUI\Service\PheanstalkService');
            $stats              =   $pheanstalk->statsTube($tube);

            // Get (next) Job stats
            $ready              =   ( $stats['current-jobs-ready'] > 0 )    ?   $pheanstalk->useTube($tube)->peekReady()     :   false;
            $delayed            =   ( $stats['current-jobs-delayed'] > 0 )  ?   $pheanstalk->useTube($tube)->peekDelayed()   :   false;
            $buried             =   ( $stats['current-jobs-buried'] > 0 )   ?   $pheanstalk->useTube($tube)->peekBuried()    :   false;
        } catch (\Pheanstalk_Exception_ServerException $e) {
            return $this->redirect()->toRoute('zf-beanstalkd');
        }

        return new ViewModel(array(
            'stats'         =>  $stats, 
            'ready'         =>  $ready, 
            'delayed'       =>  $delayed, 
            'buried'        =>  $buried,
            'pheanstalk'    =>  $pheanstalk,
        ));
    }
}
