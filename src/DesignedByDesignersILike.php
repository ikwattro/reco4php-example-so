<?php

namespace Demo;

use GraphAware\Common\Cypher\Statement;
use GraphAware\Common\Result\Record;
use GraphAware\Common\Type\Node;
use GraphAware\Common\Type\NodeInterface;
use GraphAware\Reco4PHP\Post\RecommendationSetPostProcessor;
use GraphAware\Reco4PHP\Result\Recommendation;
use GraphAware\Reco4PHP\Result\Recommendations;
use GraphAware\Reco4PHP\Result\SingleScore;

class DesignedByDesignersILike extends RecommendationSetPostProcessor
{
    public function name()
    {
        return 'boost_products_by_designer';
    }

    public function buildQuery(NodeInterface $input, Recommendations $recommendations)
    {
        $ids = [];
        foreach ($recommendations->getItems() as $recommendation) {
            $ids[] = $recommendation->item()->identity();
        }

        $query = 'MATCH (user) WHERE id(user) = {userId}
        UNWIND {ids} as productId
        MATCH (product:Product)-[:DESIGNED_BY]->(designer)
        WHERE id(product) = productId
        WITH productId, designer, user
        MATCH (user)-[:BOUGHT]->(p)-[:DESIGNED_BY]->(designer)
        RETURN productId as id, count(*) as score';

        return Statement::create($query, ['userId' => $input->identity(), 'ids' => $ids]);
    }

    public function postProcess(Node $input, Recommendation $recommendation, Record $record)
    {
        $recommendation->addScore($this->name(), new SingleScore($record->get('score')));
    }

}