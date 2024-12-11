<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241209174034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE comments ADD user_id_id INT DEFAULT NULL, ADD media_id_id INT DEFAULT NULL, ADD parrent_comment_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A605D5AE6 FOREIGN KEY (media_id_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A59F16C37 FOREIGN KEY (parrent_comment_id_id) REFERENCES comments (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A9D86650F ON comments (user_id_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A605D5AE6 ON comments (media_id_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A59F16C37 ON comments (parrent_comment_id_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9D86650F');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A605D5AE6');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A59F16C37');
        $this->addSql('DROP INDEX IDX_5F9E962A9D86650F ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A605D5AE6 ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A59F16C37 ON comments');
        $this->addSql('ALTER TABLE comments DROP user_id_id, DROP media_id_id, DROP parrent_comment_id_id');
    }
}
