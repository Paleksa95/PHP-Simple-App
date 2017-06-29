<?php

/**
 * This file is used to hash and secure any password that will be used for login in adminnlogin.php page
 *
 */


echo password_hash('PutHereAdminPassword', PASSWORD_BCRYPT);


//After echoing his hashed password , copy it in your database and save it.

