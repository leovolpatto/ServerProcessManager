<?php

namespace ServerProcessManager\Manager;

/**
 * @author leonardo
 */
interface IProcessManager {
    /**
     * @return Process[]
     */
    function GetProcessList();
    /**
     * @return ProcessDetails
     */
    function GetProcessDetails($processID);
    /**
     * @return boolean
     */    
    function KillProcess($processID);
    
}
