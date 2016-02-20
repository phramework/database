<?php
/**
 * Copyright 2015 - 2016 Xenofon Spafaridis
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
namespace Phramework\Database;

/**
 * <br/>Defined settings:<br/>
 * <ul>
 * <li>
 *   array database
 *   <ul>
 *   <li>string  adapter</li>
 *   <li>string  file, database file path</li>
 *   </ul>
 * </li>
 * </ul>
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @uses \PDO
 * @since 0.1.0
 */
class SQLite extends PostgreSQL
{
    /**
     * @var string
     */
    protected $adapterName = 'sqlite';

    /**
     * @param object $settingsDb
     * @throws DatabaseException
     */
    public function __construct($settingsDb)
    {
        //Work with arrays
        if (is_object($settingsDb)) {
            $settingsDb = (array)$settingsDb;
        }

        if (!($this->link = new PDO(sprintf(
            'sqlite:%s',
            $settingsDb['file']
        )))
        ) {
            throw new DatabaseException('Cannot connect to database');
        }

        $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}