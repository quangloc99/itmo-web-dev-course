<?php
require_once 'server/Query.php';

$que = Query::fromAssociativeArray($_GET);
//var_dump($que);
echo $que->getResult() ? 'yes' : 'no';
