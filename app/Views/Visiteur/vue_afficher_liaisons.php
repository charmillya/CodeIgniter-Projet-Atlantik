<div class="container text-center text-light">

<div class="divRounded justify-content-center">
<h2><b>Liaisons par secteur</b></h2>
</div> 

<br><br>

<table class="tableLiaisons mx-auto text-light text-center">

<tr>
    <th rowspan="2">Secteur</th>
    <th colspan="4">Liaison</th>

</tr>
<tr>
    <th>Code<br>Liaison</th>
    <th>Distance en <br> milles marin</th>
    <th>Port de départ</th>
    <th>Port d'arrivée</th>
</tr>

<?php 
$secteurCourant = "";
foreach($lesLiaisons as $uneLiaison) {
    echo "<tr>";
    if ($secteurCourant != $uneLiaison->secteurNom) {
        echo "<td><b>".$uneLiaison->secteurNom."</b></td>";
    } else {
        echo "<td></td>";
    }
    echo "<td><a href='/tarifs/".$uneLiaison->NOLIAISON."'>".$uneLiaison->NOLIAISON."</td>";
    echo "<td>".$uneLiaison->DISTANCE."</td>";
    echo "<td>".$uneLiaison->portdepart."</td>";
    echo "<td>".$uneLiaison->portarrivee."</td>";
    echo "</tr>";
    $secteurCourant = $uneLiaison->secteurNom;
}
?>

</table>

<br><br>

</div>