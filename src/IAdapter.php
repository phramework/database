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
namespace Phramework\Database;

/**
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 * @since 0.0.0
 */
interface IAdapter
{
    /**
     * Get adapter's name
     * @return string Adapter's name (lowercase)
     */
    public function getAdapterName();

    /**
     * Execute a query and return the row count
     *
     * @param string $query
     * @param array $parameters
     * @return integer
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function execute($query, $parameters = []);

    /**
     * Execute a query and return last inserted id
     *
     * @param  string $query
     * @param  array  $parameters Query parameters
     * @return integer Returns the number of rows affected or selected
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function executeLastInsertId($query, $parameters = []);


    /**
     * Execute a query and fetch first row as associative array
     *
     * @param  string $query
     * @param  array  $parameters Query parameters
     * @return array Returns a single row
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function executeAndFetch($query, $parameters = [], $castModel = null);

    /**
     * Execute a query and fetch all rows as associative array
     *
     * @param  string $query
     * @param  array  $parameters Query parameters
     * @return array[]
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function executeAndFetchAll($query, $parameters = [], $castModel = null);


    /**
     * Execute a query and fetch first row as array
     * @param string $query
     * @param array  $parameters Query parameters
     * @return array
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function executeAndFetchArray($query, $parameters = []);

    /**
     *
     * @param string $query Query string
     * @param array  $parameters Query parameters
     * @return array[]
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function executeAndFetchAllArray($query, $parameters = []);

    /**
     * Bind Execute a query and return last inserted id
     *
     * @param  string $query Query string
     * @param  array Query parameters
     * @return mixed
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function bindExecuteLastInsertId($query, $parameters = []);

    /**
     * Bind Execute a query and return the row count
     *
     * @param string $query Query string
     * @param array  $parameters Query parameters
     * @return integer
     * @throws \Phramework\Exceptions\DatabaseException
     * @todo provide documentation
     */
    public function bindExecute($query, $parameters = []);

    /**
     * Bind Execute a query and fetch first row as associative array
     *
     * @param  string $query Query string
     * @param  array  $parameters Query parameters
     * @return array
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function bindExecuteAndFetch($query, $parameters = [], $castModel = null);

    /**
     * Bind Execute a query and fetch all rows as associative array
     *
     * @param  string $query Query string
     * @param  array  $parameters Query parameters
     * @return array[]
     * @throws \Phramework\Exceptions\DatabaseException
     */
    public function bindExecuteAndFetchAll($query, $parameters = [], $castModel = null);

    /**
     * Close the connection to database
     */
    public function close();
}
