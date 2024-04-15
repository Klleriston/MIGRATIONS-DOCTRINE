<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415182342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create a new test table !';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('test');
        $table->addColumn('id', 'integer')->setAutoincrement(true);
        $table->addColumn('column_test', 'string');
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('test');
    }
}
