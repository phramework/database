<?php
/**
 * Copyright 2015 Xenofon Spafaridis
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
     * Update an entry method
     */
    public static function update($id, $keys_values, $table, $index = 'id')
    {
        $query_keys = implode('" = ?,"', array_keys($keys_values));
        $query_values = array_values($keys_values);
        //Push id to the end
        $query_values[] = $id;

        $query = 'UPDATE ';

        $table_name = '';
        if (is_array($table) &&
            isset($table['schema']) &&
            isset($table['table'])) {
            $table_name = '"' . $table['schema'] . '"'
                .'."' . $table['table'] . '"';
        } else {
            $table_name = '"' . $table . '"';
        }

        $query.= $table_name;

        $query .= ' SET "' . $query_keys . '" = ? '
            . 'WHERE ' . $table_name . '."' . $index . '" = ?';

        //Return number of rows affected
        $result = Database::execute($query, $query_values);

        return $result;
    }
}
