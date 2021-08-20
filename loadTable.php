<?php
require 'vendor/autoload.php';

use App\Connection;

$pdo = (new Connection())->connectSQL();

$table = '<thead>
<tr>
    <th scope="col">Email</th>
    <th scope="col">Dátum registrácie</th>
    <th scope="col">Predplatné</th>
</tr>
</thead>
<tbody>';

$result = $pdo->query("SELECT u.email, u.reg_date, st.type FROM User u
LEFT JOIN Subscription s ON u.id = s.user_id
LEFT JOIN Subs_type st ON st.id = s.type
ORDER BY s.end_date");

foreach ($result as $row) {
    $table .= '<tr><td>' . $row['email'] . '</td><td>' . $row['reg_date'] . '</td>';
    if($row['type'] == null) {
        $table .= '<td>Žiadne predplatné</td></tr>';
    }
    else {
        $table .= '<td>' . $row['type'] . '</td></tr>';
    }
}

$table .= '</tbody>';

echo $table;

$pdo = null;

?>