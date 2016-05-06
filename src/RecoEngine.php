<?php

namespace Demo;

use GraphAware\Reco4PHP\Engine\BaseRecommendationEngine;

class RecoEngine extends BaseRecommendationEngine
{
    public function name()
    {
        return 'demo_engine';
    }

    public function discoveryEngines()
    {
        return array(
            new PeopleBoughtLikeMeDiscovery()
        );
    }

    public function postProcessors()
    {
        return array(
            new DesignedByDesignersILike()
        );
    }

}