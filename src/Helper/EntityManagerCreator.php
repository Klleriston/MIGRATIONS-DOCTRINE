<?php

namespace Alura\Doctrine\Helper;

use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Exception\CacheException;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntityManagerCreator
{
    /**
     * @throws ORMException
     * @throws CacheException
     */
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . "/.."],
            true
        );

        $consoleOutput = new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $logMiddleware = new Middleware($consoleLogger);
        $config->setMiddlewares([$logMiddleware]);

        $cacheDirectory = __DIR__ . '././var/cache';
        $config->setMetadataCache(
            new PhpFilesAdapter(
            namespace: 'metadata_cache',
            directory: $cacheDirectory
            )
        );

        $config->setQueryCache(
            new PhpFilesAdapter(
                namespace: 'query_cache',
                directory: $cacheDirectory
            )
        );

        $config->setResultCache(
            new PhpFilesAdapter(
                namespace: 'result_query',
                directory: $cacheDirectory
            )
        );
        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        ];

        return EntityManager::create($conn, $config);
    }
}