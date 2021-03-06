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
        <link rel="stylesheet" href="GUI/css/style.css" type="text/css"/>
        <style>
        </style>
    </head>
    <body>

        <h3 style="font-family: sans-serif" ><?php echo count($process); ?> process were found</h3>
        
        <hr/>
        
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
foreach ($process as $p) {
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
    <script src="GUI/jquery-latest.js"></script>
    <script src="GUI/jquery.tablesorter.js"></script>    
    <script src="GUI/jquery.metadata.js"></script>    

    <script>
        $(document).ready(function ()
        {
            $("#tabProcess").tablesorter();
        }
        );
    </script>        
</html>
