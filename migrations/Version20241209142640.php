<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241209142640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD current_subscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9DDE45DDE FOREIGN KEY (current_subscription_id) REFERENCES subscriptions (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9DDE45DDE ON users (current_subscription_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9DDE45DDE');
        $this->addSql('DROP INDEX IDX_1483A5E9DDE45DDE ON users');
        $this->addSql('ALTER TABLE users DROP current_subscription_id');
    }
}
