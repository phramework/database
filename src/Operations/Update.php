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

use Phramework\Database\IAdapter;
use Phramework\Exceptions\DatabaseException;

/**
 * Update operation for databases
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @since 0.0.0
 */
class Update
{
    /** @var IAdapter */
    protected $adapter;

    public function __construct(IAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

     /**
      * Update database records
      * @param  string|integer $id
      * @param  object   $keysValues
      * @return integer Return number of affected records
      * @param  null|integer   $limit                **[Optional]**
      *     Limit clause, when null there is not limit.
      * @todo Add $additionalAttributes
      * @throws DatabaseException
      */
    public function update($id, \stdClass $keysValues, string $table, ?string $schema = null, $idAttribute = 'id')
    {
        //Work with arrays
        if (is_object($keysValues)) {
            $keysValues = (array)$keysValues;
        }

        $queryKeys = implode('" = ?,"', array_keys($keysValues));
        $queryValues = array_values($keysValues);

        //Push id to the end
        $queryValues[] = $id;


        if ($schema !== null) {
            $tableName = sprintf(
                '"%s"."%s"',
                $schema,
                $table
            );
        } else {
            $tableName = sprintf(
                '"%s"',
                $table
            );
        }

        $query = sprintf(
            'UPDATE %s SET "%s" = ?
              WHERE "%s" = ?',
            $tableName,
            $queryKeys,
            $idAttribute
        );

        //Return number of rows affected
        $result = $this->adapter->execute($query, $queryValues);

        return $result;
    }
}
