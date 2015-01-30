<?php

require_once 'loader.php';
$m = \ServerProcessManager\ServerProcessManager::GetInstance();
$process = $m->GetProcessManager()->GetProcessList();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Server Process Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
       <style>
            #list
            {
                font-family: cursive;
                font-size: 12px;
                font-weight: normal;
            }
            
            #list .title
            {
                font-family: serif;
                font-size: 14px;
                font-weight: normal;                
            }
            
            .colCommand{
                text-align: left;
                padding-left: 40px;
            }
            
            .colUser{
                text-align: left;
            }
            
            .colCpu
            {
                text-align: right;
            }
            
            .colMem
            {
                text-align: right;
            }
            
            .colVsz
            {
                text-align: right;
            }
            
            .colRss
            {
                text-align: right;
            }
            
            .colTime
            {
                text-align: right;
            }
            
            .colStarted
            {
                text-align: right;
            }
            
            .colPid
            {
                text-align: right;
            }
            
            .colTty
            {
                text-align: center;
            }
            
            .colStat
            {
                text-align: center;
            }
            
            button
            {
                height: 20px;
                font-size: 11px;
            }
        </style>
    </head>
    <body>
        
        <table width='100%' id='tabProcess'  class="tablesorter">
            <thead>
                <tr class="title">
                    <th></th>
                    <th class='colUser'>User</th>
                    <th class='colPid'>PID</th>
                    <th class='colCpu'>Cpu %</th>
                    <th class='colMem'>Mem %</th>
                    <th class='colVsz'>Vsz</th>
                    <th class='colRss'>Rss</th>
                    <th class='colTty'>Tty</th>
                    <th class='colStat'>Stat</th>
                    <th class='colStarted'>Started</th>
                    <th class='colTime'>Time</th>
                    <th class='colCommand'>Command</th>
                </tr>
            </thead>
            <tbody>
                
            
                
            <?php
            
            
            
            foreach($process as $p)
            {
                echo 
                "<tr>
                    <th><button>Kill</button></th>
                    <th class='colUser'>$p->user</th>
                    <th class='colPid'>$p->pid</th>
                    <th class='colCpu'>$p->cpuUsage</th>
                    <th class='colMem'>$p->memoryUsage</th>
                    <th class='colVsz'>$p->vsz</th>
                    <th class='colRss'>$p->rss</th>
                    <th class='colTty'>$p->tty</th>
                    <th class='colStat'>$p->stat</th>
                    <th class='colStarted'>$p->start</th>
                    <th class='colTime'>$p->time</th>
                    <th class='colCommand'>$p->command</th>                            
                </tr>";
            }
            
            ?>
                </tbody>
        </table>
    </body>
        <script src="jquery-latest.js"></script>
        <script src="jquery.tablesorter.js"></script>    
        <script src="jquery.metadata.js"></script>    
        <script src=""></script>    
        
        <script>
            $(document).ready(function() 
                { 
                    $("#tabProcess").tablesorter(); 
                } 
            );         
        </script>        
</html>
