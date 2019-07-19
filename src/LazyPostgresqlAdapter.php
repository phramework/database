<?php
declare(strict_types=1);

namespace Phramework\Database;

use Phramework\Exceptions\DatabaseException;

/**
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 */
class LazyPostgresqlAdapter implements IAdapter
{
    /** @var IAdapter */
    private $adapter;

    /** @var array */
    private $settingsDb;

    public function __construct(
        array $databaseSettings
    ) {
        $this->settingsDb = $databaseSettings;
    }

    /**
     * @throws DatabaseException
     */
    private function getAdapter(): IAdapter
    {
        if ($this->adapter === null) {
            $this->adapter = new PostgreSQL($this->settingsDb);
        }

        return $this->adapter;
    }

    public function getAdapterName()
    {
        return 'postgresql';
    }

    public function execute($query, $parameters = [])
    {
        return $this
            ->getAdapter()
            ->execute(
                $query,
                $parameters
            );
    }

    public function executeLastInsertId($query, $parameters = [])
    {
        return $this
            ->getAdapter()
            ->executeLastInsertId(
                $query,
                $parameters
            );
    }

    public function executeAndFetch($query, $parameters = [], $castModel = null)
    {
        return $this
            ->getAdapter()
            ->executeAndFetch(
                $query,
                $parameters,
                $castModel
            );
    }

    public function executeAndFetchAll($query, $parameters = [], $castModel = null)
    {
        return $this
            ->getAdapter()
            ->executeAndFetchAll(
                $query,
                $parameters,
                $castModel
            );
    }

    public function executeAndFetchArray($query, $parameters = [])
    {
        return $this
            ->getAdapter()
            ->executeAndFetchArray(
                $query,
                $parameters
            );
    }

    public function executeAndFetchAllArray($query, $parameters = [])
    {
        return $this
            ->getAdapter()
            ->executeAndFetchAllArray(
                $query,
                $parameters
            );
    }

    public function bindExecuteLastInsertId($query, $parameters = [])
    {
        return $this
            ->getAdapter()
            ->bindExecuteLastInsertId(
                $query,
                $parameters
            );
    }

    public function bindExecute($query, $parameters = [])
    {
        return $this
            ->getAdapter()
            ->bindExecute(
                $query,
                $parameters
            );
    }

    public function bindExecuteAndFetch($query, $parameters = [], $castModel = null)
    {
        return $this
            ->getAdapter()
            ->bindExecuteAndFetch(
                $query,
                $parameters,
                $castModel
            );
    }

    public function bindExecuteAndFetchAll($query, $parameters = [], $castModel = null)
    {
        return $this
            ->getAdapter()
            ->bindExecuteAndFetchAll(
                $query,
                $parameters,
                $castModel
            );
    }

    public function close()
    {
        if ($this->adapter !== null) {
            $this
                ->adapter
                ->close();
        }

        $this->adapter = null;
    }
}
