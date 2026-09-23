<?php
return ['default'=>env('QUEUE_CONNECTION','database'),'connections'=>['sync'=>['driver'=>'sync'],'database'=>['driver'=>'database','connection'=>env('DB_QUEUE_CONNECTION'),'table'=>'jobs','queue'=>'default','retry_after'=>90]],'failed'=>['driver'=>'database-uuids','database'=>'mysql','table'=>'failed_jobs']];
