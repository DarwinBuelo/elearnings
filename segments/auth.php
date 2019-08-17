<?php

session_start();
$userObj = isset(unserialize($_SESSION['user']));
