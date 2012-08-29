<?php
class Speedy_Plugins_Maintenance extends Zend_Controller_Plugin_Abstract{
    public function routeShutdown(Zend_Controller_Request_Abstract $request){   
        // we only want to run this if the isMaintenance flag is set	
        if(is_file(dirname(APPLICATION_PATH) . '/tmp/inMaintenance')){
            $request->setModuleName('default');
            $request->setControllerName('maintenance');
            $request->setActionName('index');
        }
    } 
}