<?php
/**
 * Copyright 2015-2016 Xenofon Spafaridis
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Phramework\Database\Operations;

use \Phramework\Database\Database;
use \Phramework\Exceptions\NotFoundException;

/**
 * Update operation for databases
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @since 0.0.0
 */
class Update
{
     /**
      * Update database records
      * @param  string|integer $id
      * @param  array|object   $keysValues
      * @param  string|array   $table                Table's name
      * @param  string         $idAttribute          **[Optional]** Id attribute
      * @return integer Return number of affected records
      * @param  null|integer   $limit                **[Optional]**
      *     Limit clause, when null there is not limit.
      * @todo Add $additionalAttributes
      */
    public static function update($id, $keysValues, $table, $idAttribute = 'id', $limit = 1)
    {
        //Work with arrays
        if (is_object($keysValues)) {
            $keysValues = (array)$keysValues;
        }

        $queryKeys = implode('" = ?,"', array_keys($keysValues));
        $queryValues = array_values($keysValues);

        //Push id to the end
        $queryValues[] = $id;

        $tableName = '';

        //Work with array
        if (is_object($table)) {
            $table = (array)$table;
        }

        if (is_array($table)
            && isset($table['schema'])
            && isset($table['table'])
        ) {

            $tableName = sprintf(
                '"%s"."%s"',
                $table['schema'],
                $table['table']
            );
        } else {
            $tableName = sprintf(
                '"%s"',
                $table
            );
        }

        $query = sprintf(
            'UPDATE %s SET "%s" = ?
              WHERE "%s" = ?
              %s',
            $tableName,
            $queryKeys,
            $idAttribute,
            (
                $limit === null
                ? ''
                : '' //'LIMIT ' . $limit
            )
        );

        //Return number of rows affected
        $result = Database::execute($query, $queryValues);

        return $result;
    }
}
