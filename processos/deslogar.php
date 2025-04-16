<?php

require_once("../templates/header.php");

$admin = new AdminDao($conn);

$admin->deslogarUsuario();