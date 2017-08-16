<?php
foreach ($users as &$user) {
    echo $user;
}
echo json_encode(compact('users'));
?>