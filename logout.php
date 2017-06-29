<?php

//Destroying all sessions and redirecting to index.php

session_start();
session_destroy();
header("Location: index.php");
