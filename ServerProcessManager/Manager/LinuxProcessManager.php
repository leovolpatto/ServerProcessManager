<?php

namespace ServerProcessManager\Manager;

/**
 * Description of LinuxProcessManager
 *
 * @author leonardo
 */
final class LinuxProcessManager implements IProcessManager {
        
    public function __construct() {
   
    }
   
    public function GetProcessDetails($processID) {
        
    }

    /**
     * @return Process[]
     */
    public function GetProcessList() {
        
        $pids = $this->GetPidInfo();
        $process = array();
        $first = true;
        foreach($pids as $info)
        {
            if($first)//refactor
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
        $r = exec("kill $processID", $output);
        
        var_dump($r);
        var_dump($output);
    }
    

    private function GetPidInfo($ps_opt = "aux") {

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
   
}
