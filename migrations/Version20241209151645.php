<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241209151645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE playlist_subscriptions (id INT AUTO_INCREMENT NOT NULL, subscribed_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_subscriptions_playlist (playlist_subscriptions_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_98FDFFD592A9BF9B (playlist_subscriptions_id), INDEX IDX_98FDFFD56BBD148 (playlist_id), PRIMARY KEY(playlist_subscriptions_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_subscriptions_users (playlist_subscriptions_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_3097003692A9BF9B (playlist_subscriptions_id), INDEX IDX_3097003667B3B43D (users_id), PRIMARY KEY(playlist_subscriptions_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist_subscriptions_playlist ADD CONSTRAINT FK_98FDFFD592A9BF9B FOREIGN KEY (playlist_subscriptions_id) REFERENCES playlist_subscriptions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_subscriptions_playlist ADD CONSTRAINT FK_98FDFFD56BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_subscriptions_users ADD CONSTRAINT FK_3097003692A9BF9B FOREIGN KEY (playlist_subscriptions_id) REFERENCES playlist_subscriptions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_subscriptions_users ADD CONSTRAINT FK_3097003667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE playlist_subscriptions_playlist DROP FOREIGN KEY FK_98FDFFD592A9BF9B');
        $this->addSql('ALTER TABLE playlist_subscriptions_playlist DROP FOREIGN KEY FK_98FDFFD56BBD148');
        $this->addSql('ALTER TABLE playlist_subscriptions_users DROP FOREIGN KEY FK_3097003692A9BF9B');
        $this->addSql('ALTER TABLE playlist_subscriptions_users DROP FOREIGN KEY FK_3097003667B3B43D');
        $this->addSql('DROP TABLE playlist_subscriptions');
        $this->addSql('DROP TABLE playlist_subscriptions_playlist');
        $this->addSql('DROP TABLE playlist_subscriptions_users');
    }
}
