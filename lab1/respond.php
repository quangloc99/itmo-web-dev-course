<?php
require_once 'src/Query.php';

session_start();

if (!array_key_exists('queries', $_SESSION)) {
    $_SESSION['queries'] = array();
}
/** @var Query[] $queries */
$queries = &$_SESSION['queries'];
/** @var Exception|null $queryError */
$queryError = null;

try {
    $queries[] = Query::fromAssociativeArray($_GET);
} catch (ParseError $exception) {
    $queryError = $exception;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="client/css/color-palette.css">
    <link rel="stylesheet" type="text/css" href="client/css/shared.css">
    <link rel="stylesheet" type="text/css" href="client/css/respond.css">
</head>
<body>
    <?php if ($queryError != null) { ?>
        <div class="error-message">Error: <?= $queryError->getMessage() ?> </div>
    <?php } ?>
    <table>
        <thead><tr>
            <th scope="col">Point X</th>
            <th scope="col">Point Y</th>
            <th scope="col">Parameter R</th>
            <th scope="col">Result (Point lies inside the graph?)</th>
            <th scope="col">Query time</th>
        </tr></thead>
        <tbody>
        <?php
            foreach (array_reverse($queries) as $query) {
                echo ($query->toHTMLTableRow());
            }
        ?>
        </tbody>
    </table>
</body>
</html>
