<?php

use App\Framework\Tables\Builder\QueryBuilder;
use App\Framework\Tables\Connection;




// var_dump(Connection::getPDO()->query("SELECT * FROM dead INNER JOIN malade ON reference = cause")->fetchAll(PDO::FETCH_CLASS,DecesTable::class)[1]->firtsname);

     
// for ($i = 1; $i < 400; $i++) {
//     (new QueryBuilder(Connection::getPDO()))
//     ->insert()
//     ->set(
//         'name','lastname', 'happy', 'date_d', 'happy_l',  'maried_q', 'sexe',
//             'cause', 'firtsname'
//     )
//     ->datetime('datecreate', "NOW()")
//     ->datetime("updatedate", "NOW()")
//     ->from('dead')
//     ->values([
//         ':name' => "ululer". $i,
//         ':lastname' => "personne". $i,
//         ':firtsname' => "personne". $i,
//         ':happy' => "2012-04-11",
//         ':happy_l' => "france",
//         ':date_d' => "2012-04-11",
//         ':maried_q' => "2012-04-11",
//         ':cause' => "@accident",
//         ':sexe' => "Femme"
//     ])
//     ->execute();
// }