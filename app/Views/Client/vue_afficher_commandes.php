<div class="text-light divRounded text-center">
<h2><b>Mes commandes</b></h2>
</div>

<br><br><br>

<div class="text-light text-center divReservation">

    <br>
    <table class="tableLiaisons text-light text-center mx-auto">
        <tr>
            <td><b>N° de réservation</b></td>
            <td><b>Date de réservation</b></td>
            <td><b>Départ</b></td>
            <td><b>Arrivée</b></td>
            <td><b>Date de départ</b></td>
            <td><b>Total</b></td>
            <td><b>Statut de paiement</b></td>
        </tr>
        <?php foreach($commandesClient as $uneCommande) {
            echo '<tr>';
            echo '<td>'.$uneCommande->NORESERVATION.'</td>';
            echo '<td>'.date('d/m/Y', strtotime($uneCommande->DATERESERVATION)).'</td>';
            echo '<td>'.$uneCommande->PORTDEPART.'</td>';
            echo '<td>'.$uneCommande->PORTARRIVEE.'</td>';
            echo '<td>'.date('d/m/Y', strtotime($uneCommande->DATETRAVERSEE)).'</td>';
            echo '<td>'.$uneCommande->TOTAL.'€</td>';
            if($uneCommande->PAYE == 1) {
                echo '<td><b>Payé</b></td>';
            } else {
                echo '<td><b>Non payé</b></td>';
            }
            echo '</tr>';
        }?>

    </table>
    <br>
    <div class="pagination justify-content-center">
        <?= $pager->links('default', 'pagination_bootstrap') ?>
    </div>
    <br>
</div>

<br><br><br>