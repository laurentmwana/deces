<?php

namespace App\Model;

use App\Tables\Builder\QueryBuilder;
use App\Tables\Connection;

class Model {


    /**
     * @return QueryBuilder
     */
    public function query (): QueryBuilder {
        return new QueryBuilder(Connection::getPDO());
    }
}