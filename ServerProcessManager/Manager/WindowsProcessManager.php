<?php

namespace ServerProcessManager\Manager;

/**
 * Based on Windows 8.1
 */
final class WindowsProcessManager implements IProcessManager {

    public function GetProcessDetails($processID) {
        
    }
    
    public function GetProcessList() {
        exec("tasklist /V /FO CSV 2>NUL", $task_list);
        
        $ps = array();
        for ($i = 1; $i < count($task_list); $i++) {
            $ar = str_getcsv($task_list[$i]);

            $p = new Process();
            $p->command = $ar[0];
            $p->cpuUsage = $ar[7];
            $p->memoryUsage = $ar[4];
            $p->pid = $ar[1];
            $p->rss = '';
            $p->start = '';
            $p->stat = $ar[5];
            $p->time = $ar[7];
            $p->tty = '';
            $p->user = $ar[6];
            $p->vsz = '';
            array_push($ps, $p);
        }

        return $this->CalculateCpuUsage($ps);
    }

    /**
     * @category Not Tested
     */
    public function KillProcess($processID) {
       $r = exec("tasklist /PID $processID 2>NUL");
        
        var_dump($r);
        die;
    }

    /**
     * Calculates the CPU % usage for each process. I'm not pretty sure if this calculation is right. Any help here would be apreciated :)
     * @param Process[] $processes
     * @return Process[]
     */
    private function CalculateCpuUsage($processes)
    {
        $totalSeconds = $this->CalculateCpuTotalTime($processes);
        $totalIdleSeconds = $this->CalculateCpuIdleTotalTime($processes);

        foreach ($processes as $p)
        {
            if ($p->pid != 0) {
                $seconds = $this->GetSeconds($p->time);
                $percent = (($seconds * 100) / ($totalIdleSeconds - $totalSeconds)) / 100;
                $p->cpuUsage = round(floatval($percent) * 100, 1);
            } else { //idle process:
                $percent = $totalIdleSeconds * 100 / ($totalIdleSeconds + $totalSeconds);
                $p->cpuUsage = number_format($percent);
            }            
        }
        
        return $processes;
    }  
    
    /**
     * @param Process[] $processes
     */
    private function CalculateCpuTotalTime($processes)
    {
        $time = "00:00:00";
        for ($i = 1; $i < count($processes); $i++) {            
            if ($processes[$i]->pid == '0')
                continue;
            $time = $this->sum_the_time($time, $processes[$i]->time);
        }
        
        return $this->GetSeconds($time);
    }

    /**
     * @param Process[] $processes
     */
    private function CalculateCpuIdleTotalTime($processes)
    {
        $time = "00:00:00";
        for ($i = 0; $i < count($processes); $i++) {            
            if ($processes[$i]->pid == '0')
            {
                $time = $this->sum_the_time($time, $processes[$i]->time);
                break;
            }
        }
        
        return $this->GetSeconds($time);
    }    

    private function GetSeconds($time) {
        $ar = explode(':', $time);

        $totalSeconds = $ar[2];
        $totalSeconds += $ar[1] * 60;
        $totalSeconds += $ar[0] * 60 * 60;

        return $totalSeconds;
    }    
    
    /**
     * @author Masino Sinaga, http://www.openscriptsolution.com
     * @copyright October 13, 2009
     */
    function sum_the_time($time1, $time2) {
        $times = array($time1, $time2);
        $seconds = 0;
        foreach ($times as $time) {
            list($hour, $minute, $second) = explode(':', $time);
            $seconds += $hour * 3600;
            $seconds += $minute * 60;
            $seconds += $second;
        }
        $hours = floor($seconds / 3600);
        $seconds -= $hours * 3600;
        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;
        // return "{$hours}:{$minutes}:{$seconds}";
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
    }    

}
