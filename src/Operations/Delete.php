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

/**
 * Delete operation for databases
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @since 0.0.0
 */
class Delete
{
    /**
     * Delete database records
     * @param  string|integer $id
     *     Id value
     * @param  array|object   $additionalAttributes
     *     Additional attributes to use in WHERE $idAttribute
     * @param  string|array   $table                Table's name
     * @param  string         $idAttribute          **[Optional]**
     *     Id attribute
     * @param  null|integer   $limit                **[Optional]**
     *     Limit clause, when null there is not limit.
     * @return integer Return number of affected records
     */
    public static function delete($id, $additionalAttributes, $table, $idAttribute = 'id', $limit = 1)
    {
        $queryValues = [$id];

        $additional = [];

        foreach ($additionalAttributes as $key => $value) {
            //push to additional
            $additional[] = sprintf(
                'AND "%s"."%s" = ?',
                $table,
                $key
            );
            $queryValues[] = $value;
        }

        $tableName = '';
        if (is_array($table) &&
            isset($table['schema']) &&
            isset($table['table'])) {
            $tableName = '"' . $table['schema'] . '"'
                .'."' . $table['table'] . '"';
        } else {
            $tableName = '"' . $table . '"';
        }

        $query = sprintf(
            'DELETE FROM %s
            WHERE "%s" = ?
              %s
              %s',
            $tableName,
            $idAttribute,
            implode("\n", $additional),
            (
                $limit === null
                ? ''
                : 'LIMIT ' . $limit
            )
        );

        return Database::execute($query, $queryValues);
    }
}
