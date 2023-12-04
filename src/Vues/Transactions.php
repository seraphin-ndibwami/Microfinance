<div class="contenu frestretch">
    <?php
    require('barelaterale.php');
    $cls = "";
    if ($clients) {

        foreach ($clients as $id => $value) {
            $cl = $id . $value->getNomComplet() . $value->getNumeroCompte() . ' solde' . $value->getSolde();
            $cls =  $cls . "<option value='$id'>$cl</option>";
        }
    }
    ?>
    <h2>Enregistrer une transaction</h2>
    <form action="http://localhost/src/Controlleurs/Transactions.php" method="post">
        <label for="client_origine">Client Origine :</label>
        <select id="client_origine" name="client_origine">
            <?= $cls ?>
        </select>
        <label for="client_destinataire">Client Destinataire :</label>
        <select id="client_destinataire" name="client_destinataire">
            <?= $cls ?>
        </select>
        <label for="montant">Montant :</label>
        <input type="number" id="montant" name="montant" step="0.01" required><br><br>

        <input type="hidden" id="date" name="date" required><br><br>

        <input type="hidden" id="type" name="type" value="transaction">

        <input type="submit" value="Enregistrer">
    </form>
</div>