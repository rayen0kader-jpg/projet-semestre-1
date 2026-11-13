<?php
// Maison - Exercice 1 : gestion des notes
$notes = [12, 15, 9, 14, 16];

function somme($notes)
{
    $total = 0;
    foreach ($notes as $n) {
        $total += $n;
    }
    return $total;
}

function moyenne($notes)
{
    return count($notes) > 0 ? somme($notes) / count($notes) : 0;
}

function maximum($notes)
{
    $max = $notes[0];
    foreach ($notes as $n) {
        if ($n > $max) {
            $max = $n;
        }
    }
    return $max;
}

function minimum($notes)
{
    $min = $notes[0];
    foreach ($notes as $n) {
        if ($n < $min) {
            $min = $n;
        }
    }
    return $min;
}

function compterNotesSuperieuresOuEgalesA10($notes)
{
    $compteur = 0;
    foreach ($notes as $n) {
        if ($n >= 10) {
            $compteur++;
        }
    }
    return $compteur;
}
?>
<!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><title>Notes</title></head>
<body>
<h1>Gestion des notes</h1>
<p>Notes : <?= implode(", ", $notes) ?></p>
<ul>
    <li>Somme : <?= somme($notes) ?></li>
    <li>Moyenne : <?= moyenne($notes) ?></li>
    <li>Maximum : <?= maximum($notes) ?></li>
    <li>Minimum : <?= minimum($notes) ?></li>
    <li>Notes ≥ 10 : <?= compterNotesSuperieuresOuEgalesA10($notes) ?></li>
</ul>
<p><a href="index.php">Retour</a></p>
</body></html>
