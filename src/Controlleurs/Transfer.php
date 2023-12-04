<?php
use Microfinance\Models\Transactions;
require('./src/Models/Bd.php');

$transactions = Transactions::recupererTousLesTRansfer($connexion);
