<?php

require_once __DIR__ . '/../function/function.php';

header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT MONTH(date_created) AS mes, COUNT(*) AS total
        FROM orders
        WHERE YEAR(date_created) = YEAR(CURDATE())
        GROUP BY MONTH(date_created)";

$result = $conn->query($sql);

$pedidos = array_fill(1, 12, 0);

while ($row = $result->fetch_assoc()) {
    $pedidos[(int)$row['mes']] = (int)$row['total'];
}

echo json_encode(array_values($pedidos));

?>