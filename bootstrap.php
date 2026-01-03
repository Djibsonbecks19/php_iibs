<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
require_once "vendor/autoload.php";
// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfig( // on PHP < 8.4, use ORMSetup::createAttributeMetadataConfiguration()
    paths: [__DIR__ . '/model'],
    isDevMode: true,
);
// or if you prefer XML
// $config = ORMSetup::createXMLMetadataConfig( // on PHP < 8.4, use ORMSetup::createXMLMetadataConfiguration()
//    paths: [__DIR__ . '/config/xml'],
//    isDevMode: true,
//);
// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_pgsql',
    'host' => 'localhost',
    'port' => 5434,
    'dbname' => 'postgres',
], $config);
// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);