<?php
require_once 'src/Query.php';

session_start();

if (!array_key_exists('queries', $_SESSION)) {
    $_SESSION['queries'] = array();
}
/**
 * @var Query[] $queries
 * @var Exception|null $queryError
 * @var Query $newQuery
 */
$queries = &$_SESSION['queries'];
$queryError = null;
$newQuery = null;

try {
    $newQuery = Query::fromAssociativeArray($_GET);
    $queries[] = $newQuery;
    $xIsValid = -3 <= $newQuery->getX() && $newQuery->getX() <= 5;
    $yIsValid = -3 <= $newQuery->getY() && $newQuery->getY() <= 5;
    $rIsValid = 1 <= $newQuery->getR() && $newQuery->getR() <= 5;
    if (!$xIsValid) {
        throw new Exception('X is out of range. But since it ok, the query is still processed.');
    }
    if (!$yIsValid) {
        throw new Exception('Y is out of range. But since it ok, the query is still processed.');
    }
    if (!$rIsValid) {
        throw new Exception('R is out of range. But since it ok, the query is still processed.');
    }
} catch (Exception $exception) {
    $queryError = $exception;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab 1 - Queries result</title>
    <link rel="stylesheet" type="text/css" href="client/css/color-palette.css">
    <link rel="stylesheet" type="text/css" href="client/css/shared.css">
    <link rel="stylesheet" type="text/css" href="client/css/respond.css">
</head>
<body>
    <header>
        <h2>Queries result</h2>
    </header>
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
        <?php foreach (array_reverse($queries) as $query) { ?>
            <tr <?php echo $query === $newQuery ? 'class="new-query"' : '' ?> >
                <?= $query->toHTMLTableRow() ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
