<?php

namespace Drupal\crud_testing\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\NodeType;

class CrudController extends ControllerBase
{
    public function index()
    {
        $query = \Drupal::entityQuery('node');


        $last_year = time() - 60*60*24*365;

        $new_nodes = $query
            ->condition('created', $last_year, '>=')
            ->sort('created', 'DESC')
            ->execute();


        dump($new_nodes);

        return new Response('crud testing');
    }

    public function createEntity()
    {

    }

    public function updateEntity()
    {

    }

    public function deleteEntity()
    {

    }
}