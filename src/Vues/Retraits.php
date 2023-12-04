<div class="contenu frestretch">
    <?php
    require('barelaterale.php');
    ?>
    <div class="page">
        <h1>Gestion des Retraits</h1>

        <!-- Bouton pour un nouveau dépôt -->
        <button id="nouveau-depot-btn">Nouveau Retrait</button>
        <div class="formulaireDepot">
            <h2>Retirer de l'argent</h2>
            <form action="http://localhost/src/Controlleurs/Transactions.php" method="post">
                <label for="client_origine">Client </label>
                <select id="client_origine" name="client_origine">
                    <!-- Remplacez ces options par la liste de vos clients depuis la base de données -->
                    <?php
                    if ($clients) {
                        foreach ($clients as $id => $value) {
                            $cl = $id . $value->getNomComplet() . $value->getNumeroCompte() . ' solde' . $value->getSolde();
                    ?>
                            <option value="<?= $id ?>"><?= $cl ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="montant">Montant :</label>
                <input type="number" id="montant" name="montant" step="0.01" required><br><br>

                <input type="hidden" id="date" name="date" required><br><br>

                <input type="hidden" id="type" name="type" value="transaction">

                <input type="submit" value="Enregistrer">
            </form>
        </div>
        <h2>Anciens Retraits</h2>
        <div class="anciens-depots">
            <table>
                <tr>
                    <th></th>
                    <th>operateur</th>
                    <th>Montant</th>
                    <th>Date</th>
                </tr>

                <?php
                if ($transactions) {
                    foreach ($transactions as $id => $value) {
                        $client = $value->getIdClientOrigine();
                        echo "<tr>";
                        echo "<td>" . $id .  "</td>";
                        echo "<td>" . $client->getNomComplet() . "</td>";
                        echo "<td>" . $value->getMontant() . "</td>";
                        echo "<td>" . $value->getdate_transaction() . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>