
<?php
echo "<h3>For Loop: Angka 1 sampai 50</h3>";
for ($i = 1; $i <= 50; $i++) {
    if ($i % 2 == 0) {
        echo "<span style='color: red;'>$i</span> ";
    } else {
        echo "$i ";
    }
}

echo "<br><br>";

echo "<h3>While Loop: Angka 25 sampai 75</h3>";
$i = 25;
while ($i <= 75) {
    if ($i % 2 != 0) {
        echo "<span style='color: blue;'>$i</span> ";
    } else {
        echo "$i ";
    }
    $i++;
}
?>
