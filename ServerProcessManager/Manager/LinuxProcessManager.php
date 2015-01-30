<?php

namespace ServerProcessManager\Manager;

/**
 * Description of LinuxProcessManager
 *
 * @author leonardo
 */
final class LinuxProcessManager implements IProcessManager {
        
    public function __construct() {
        $this->GetProcessList();
    }
    
    private function ParseProcessPidList($obj)
    {
        $pids = array();
        foreach($obj as $o)
        {
            $exp = explode(' ', $o);
            foreach($exp as $e)
            {
                if(strlen(trim($e)) > 0)
                {
                    if(is_numeric($e))
                    {
                        array_push($pids, $e);
                        break;
                    }
                }
            }
        }
        return $pids;
    }
    
    function GetPidInfo($ps_opt = "aux") {

        $ps = shell_exec("ps " . $ps_opt);
        $ps = explode("\n", $ps);

        foreach ($ps as $key => $val) {
            $ps[$key] = explode(" ", ereg_replace(" +", " ", trim($ps[$key])));
        }

        foreach ($ps[0] as $key => $val) {
            $pidinfo[$val] = $ps[1][$key];
            unset($ps[1][$key]);
        }

        if (is_array($ps[1])) {
            $pidinfo[$val].=" " . implode(" ", $ps[1]);
        }
        //return $pidinfo;
        return $ps;
    }

    public function GetProcessDetails($processID) {
        
    }

    /**
     * @return Process[]
     */
    public function GetProcessList() {
        //$ret = exec('ps -aux', $output);
        //$ps = shell_exec("ps -aux");        
        //$ret = exec('ps -e', $output);
        //$pids = $this->ParseProcessPidList($output);
        
        $pids = $this->GetPidInfo();
        $process = array();
        $first = true;
        foreach($pids as $info)
        {
            if($first)
            {
                $first = false;
                continue;
            }
            
            $pr = new Process();
            $pr->user = $info[0];
            $pr->pid = $info[1];
            $pr->cpuUsage = $info[2];
            $pr->memoryUsage = $info[3];
            $pr->vsz = $info[4];
            $pr->rss = $info[5];
            $pr->tty = $info[6];
            $pr->stat = $info[7];
            $pr->start = $info[8];
            $pr->time = $info[9];
            $pr->command = $info[10];
            
            array_push($process, $pr);
        }
        return $process;
    }

    public function KillProcess($processID) {
        
    }

}
