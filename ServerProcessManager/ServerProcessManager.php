<?php

namespace ServerProcessManager;

/**
 * @author leonardo
 */
final class ServerProcessManager {
    
    /**
     * @var ServerProcessManager
     */
    private static $instance;
    
    /**
     * @return ServerProcessManager
     */
    public static function GetInstance()
    {
        if(self::$instance == null)
            self::$instance = new ServerProcessManager();
        
        return self::$instance;
    }
    
    /**
     * @var Manager\IProcessManager
     */
    private $manager;
    
    private function __construct() {
        $this->DetectOS();
    }
    
    private function DetectOS()
    {
        switch (strtolower(PHP_OS))
        {
            case 'linux':
                $this->manager = new Manager\LinuxProcessManager();
                break;
            default:
                throw new \Exception('Not implemented yet');
        }
    }
    
    /**
     * @return Manager\IProcessManager
     */
    public function GetProcessManager()
    {
        return $this->manager;
    }
    
}
