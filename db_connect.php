<?php
session_start();
$mongo = new MongoClient("mongodb://localhost");

if ($mongo) {	
   $_SESSION['connection'] = 1;
   $db = $mongo->PennApps;
   $users = $db->users;
} else {
   $_SESSION['connection'] = 0;
}
?> 
