<?php
require 'init.php';

$file = FileManager::Load(8);
Util::debug($file->getOwnersName());