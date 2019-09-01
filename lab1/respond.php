<?php
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
    <link rel="stylesheet" type="text/css" href="client/css/shared.css">
    <link rel="stylesheet" type="text/css" href="client/css/respond.css">
</head>
<body>
    <table>
        <thead>
            <th scope="col">Point X</th>
            <th scope="col">Point Y</th>
            <th scope="col">Parameter R</th>
            <th scope="col">Result (Point lies inside the graph?)</th>
        </thead>
        <tbody>
        <?php
            foreach ($queries as $query) {
                echo ($query->toHTMLTableRow());
            }
        ?>
        </tbody>
    </table>
</body>
