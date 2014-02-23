<?php
require 'vendor/autoload.php';

use Ggggino\CsvMapper;

$obj = new CsvMapper("example/sample2.csv");
#print_r($obj->stampCsv());
#print_r($obj->getBy("nome", 'David'));
print_r($obj->selDistinctHead("nome"));
#var_dump($obj);
?>