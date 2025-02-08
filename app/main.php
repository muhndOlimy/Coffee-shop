<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Configs\DBConfigs;
use Configs\Env;
use Models\Country;
use Repositories\Repository;

Env::loadEnvFile();

$dbConfigs = DBConfigs::fromEnv();
$dbDataSource = new DBDataSource($dbConfigs);
$dbDataSource->connect();
//$result = $dbDataSource->execute("INSERT INTO users (username, password, first_name, last_name, email, state_id) VALUES (?,?,?,?,?,?);");
$repo = new Repository($dbDataSource, Country::class);
$row = $repo->findById(29);
$row->name = 'Egypt 2';
print_r($repo->update($row));




