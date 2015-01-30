<?php

namespace ServerProcessManager\Manager;

/**
 * @author leonardo
 */
final class Process {
    
    public $pid;
    
    /**
     * @var ProcessDetails
     */
    public $processDetails;
    
    public $user;
    public $cpuUsage;
    public $memoryUsage;
    public $vsz;
    public $rss;
    public $tty;
    public $stat;
    public $start;
    public $time;
    public $command;
    
}
