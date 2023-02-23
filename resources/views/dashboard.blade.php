<?php
$user = Auth::user();

echo "Welcome, " . $user->name . "!";
?>

<a href="/logout">Logout</a>
<br>
