<?php

include(__DIR__ . '/../function/connection.php');

header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT MONTH(data_created) AS mes, COUNT(*) AS total
        FROM orders
        WHERE YEAR(data_created) = YEAR(CURDATE())
        GROUP BY MONTH(data_created)";

$result = $conn->query($sql);

$pedidos = array_fill(1, 12, 0);

while ($row = $result->fetch_assoc()) {
    $pedidos[(int)$row['mes']] = (int)$row['total'];
}

echo json_encode(array_values($pedidos));

?>