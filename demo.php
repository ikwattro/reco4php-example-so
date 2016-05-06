<?php

require_once __DIR__.'/vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;
use GraphAware\Reco4PHP\RecommenderService;

$client = ClientBuilder::create()
    ->addConnection('default', 'bolt://localhost')
    ->build();

$recoService = RecommenderService::create('bolt://localhost');
$recoService->registerRecommendationEngine(new \Demo\RecoEngine());

$user = new \Demo\NodeProxy(19);

$s = microtime(true);
$recommendations = $recoService->getRecommender('demo_engine')->recommend($user);
$e = microtime(true) - $s;
echo $s . 'ms' . PHP_EOL;

$recommendations->sort();
print_r($recommendations->get(3));
