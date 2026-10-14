<?php
$note1 = 12;
$note2 = 15;
$note3 = 14;

$moyenne = ($note1 + $note2 + $note3) / 3;

echo "<h1>Calcul de la moyenne</h1>";
echo "<p>Note 1 : $note1</p>";
echo "<p>Note 2 : $note2</p>";
echo "<p>Note 3 : $note3</p>";
echo "<p>Moyenne : " . number_format($moyenne, 2) . "</p>";

if ($moyenne >= 10) {
    echo "<p>Résultat : Admis</p>";
} else {
    echo "<p>Résultat : Non admis</p>";
}
?>
