<?php
require_once 'server/Query.php';

$que = Query::fromAssociativeArray($_GET);
?>
<body>
    <table>
        <?= $que->toHTMLTableRow()?>
    </table>
</body>
