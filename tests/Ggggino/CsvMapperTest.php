<?php
use Ggggino\CsvMapper;
class MoneyTest extends PHPUnit_Framework_TestCase
{
    // ...

    public function testCanBeNegated()
    {
        $obj = new CsvMapper("../../example/sample2.csv");
        print_r($obj->stampCsv());
        print_r($obj->getBy("nome", 'David'));
    }

    // ...
}