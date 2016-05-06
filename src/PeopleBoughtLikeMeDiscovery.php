<?php

namespace Demo;

use GraphAware\Common\Cypher\Statement;
use GraphAware\Common\Type\NodeInterface;
use GraphAware\Reco4PHP\Engine\SingleDiscoveryEngine;

class PeopleBoughtLikeMeDiscovery extends SingleDiscoveryEngine
{
    public function name()
    {
        return 'people_bought_like_me';
    }

    public function discoveryQuery(NodeInterface $input)
    {
        $query = 'MATCH (user) WHERE id(user) = {id}
        MATCH (user)-[:BOUGHT]->(product)<-[:BOUGHT]-(other)
        WITH distinct other
        MATCH (other)-[:BOUGHT]->(reco)
        RETURN distinct reco, count(*) as score
        ORDER BY score DESC
        LIMIT 1000';

        return Statement::create($query, ['id' => $input->identity()]);
    }

}