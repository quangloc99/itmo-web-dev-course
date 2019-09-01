<?php
//phpinfo();
require_once 'src/Query.php';

session_start();

if (!array_key_exists('queries', $_SESSION)) {
    $_SESSION['queries'] = array();
}
$queries = &$_SESSION['queries'];
$queries[] = Query::fromAssociativeArray($_GET);

?>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <tbody>
        <?php
            foreach ($queries as $query) {
                echo ($query->toHTMLTableRow());
            }
        ?>
        </tbody>
    </table>
</body>
