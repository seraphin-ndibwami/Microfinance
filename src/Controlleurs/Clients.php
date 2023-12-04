<?php
use Microfinance\Models\Client;
require('./src/Models/Bd.php');

$clients = Client::recupererClients($connexion);

