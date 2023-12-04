<div class="contenu flex">
<?php
require('barelaterale.php');
?>
<div class="transactions">
<h1>Effectuer une transaction</h1>
    <form action="traitement_effectuer_transaction.php" method="POST">
        <label for="id_client_origine">ID client origine :</label>
        <input type="text" id="id_client_origine" name="id_client_origine" required><br><br>

        <label for="id_client_destinataire">ID client destinataire :</label>
        <input type="text" id="id_client_destinataire" name="id_client_destinataire" required><br><br>

        <label for="montant">Montant :</label>
        <input type="text" id="montant" name="montant" required><br><br>

        <label for="type_transaction">Type de transaction :</label>
        <select id="type_transaction" name="type_transaction">
            <option value="depot">Dépôt</option>
            <option value="retrait">Retrait</option>
        </select><br><br>

        <input type="submit" value="Effectuer la transaction">
    </form>
</div>
</div>
<style>
    /* Styles pour les formulaires */
body {
    font-family: "Roboto", sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
.flex{
    display: flex;
    align-items: center;
}
h1 {
    text-align: center;
}

form {
    width: 50%;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="submit"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

</style>