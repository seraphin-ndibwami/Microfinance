<div class="contenu frestretch">
    <?php
        require('barelaterale.php');
    ?>
    <div class="page gap1 fcs">
        <div class="gap1 fc">
            <i class="menu">
                <svg width="24" height="24"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0599 10.0905C12.8463 10.0905 15.1051 7.83164 15.1051 5.04523C15.1051 2.25883 12.8463 0 10.0599 0C7.27348 0 5.01465 2.25883 5.01465 5.04523C5.01465 7.83164 7.27348 10.0905 10.0599 10.0905Z" />
                    <path d="M13.293 19.314H18.7599V20.4074H13.293V19.314Z" />
                    <path d="M8.60671 20.876V23.219C8.60671 23.4262 8.68899 23.6248 8.83546 23.7713C8.98192 23.9177 9.18057 24 9.3877 24H22.6646C22.8718 24 23.0704 23.9177 23.2169 23.7713C23.3633 23.6248 23.4456 23.4262 23.4456 23.219V15.4091C23.4456 15.2019 23.3633 15.0033 23.2169 14.8568C23.0704 14.7104 22.8718 14.6281 22.6646 14.6281H17.1977V13.48C17.1977 13.2729 17.1154 13.0742 16.9689 12.9278C16.8225 12.7813 16.6238 12.699 16.4167 12.699C16.2095 12.699 16.0109 12.7813 15.8644 12.9278C15.718 13.0742 15.6357 13.2729 15.6357 13.48V14.6281H14.0737V11.8321C12.7465 11.6154 11.4041 11.5057 10.0594 11.5041C7.09376 11.4915 4.1614 12.1286 1.46841 13.3707C1.02518 13.5798 0.651257 13.9118 0.391005 14.3271C0.130754 14.7423 -0.00490145 15.2236 0.00013533 15.7137V20.876H8.60671ZM21.8836 22.438H10.1687V16.1901H15.6357V16.5181C15.6357 16.7252 15.718 16.9239 15.8644 17.0703C16.0109 17.2168 16.2095 17.2991 16.4167 17.2991C16.6238 17.2991 16.8225 17.2168 16.9689 17.0703C17.1154 16.9239 17.1977 16.7252 17.1977 16.5181V16.1901H21.8836V22.438Z" />
                </svg>
            </i>
            <h1 class="item">
                Clients
            </h1>
        </div>
        <div class="client-list  support bd5">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom complet</th>
                    <th>Numéro de téléphone</th>
                    <th>Solde</th>
                    <th>Adresse physique</th>
                    <th>Numéro de compte</th>
                </tr>
                <?php

                if ($clients){
                    foreach ($clients as $id => $value) {
                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $value->getNomComplet() . "</td>";
                        echo "<td>" . $value->getNumeroTelephone() . "</td>";
                        echo "<td>" . $value->getSolde() . "</td>";
                        echo "<td>" . $value->getAdressePhysique() . "</td>";
                        echo "<td>" . $value->getNumeroCompte() . "</td>";
                        echo "<td><a href='http://localhost/src/Controlleurs/Nouveauclient.php?action=supprimer&id=$id'>supprimer</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                <!-- Fin de la partie PHP -->
            </table>
        </div>
        <div class="formClient bd5 support" id="nouveauclient">
            <h1>Créer un client</h1>
            <form action="http://localhost/src/Controlleurs/Nouveauclient.php" method="POST">
                <label for="nom_complet">Nom complet :</label>
                <input type="text" id="nom_complet" name="nom_complet" required><br><br>

                <label for="numero_telephone">Numéro de téléphone :</label>
                <input type="text" id="numero_telephone" name="numero_telephone"><br><br>

                <label for="solde">Solde :</label>
                <input type="text" id="solde" name="solde"><br><br>

                <label for="adresse_physique">Adresse physique :</label>
                <input type="text" id="adresse_physique" name="adresse_physique"><br><br>

                <label for="numero_compte">Numéro de compte :</label>
                <input type="text" id="numero_compte" name="numero_compte" required><br><br>

                <input type="submit" value="Créer le client">
            </form>
        </div>
    </div>
</div>
