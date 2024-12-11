<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241211081159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE playlist_media (id INT AUTO_INCREMENT NOT NULL, added_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_media_media (playlist_media_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_50F8E39217421B18 (playlist_media_id), INDEX IDX_50F8E392EA9FDD75 (media_id), PRIMARY KEY(playlist_media_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_media_playlist (playlist_media_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_63FEBFA717421B18 (playlist_media_id), INDEX IDX_63FEBFA76BBD148 (playlist_id), PRIMARY KEY(playlist_media_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist_media_media ADD CONSTRAINT FK_50F8E39217421B18 FOREIGN KEY (playlist_media_id) REFERENCES playlist_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_media_media ADD CONSTRAINT FK_50F8E392EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_media_playlist ADD CONSTRAINT FK_63FEBFA717421B18 FOREIGN KEY (playlist_media_id) REFERENCES playlist_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_media_playlist ADD CONSTRAINT FK_63FEBFA76BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE playlist_media_media DROP FOREIGN KEY FK_50F8E39217421B18');
        $this->addSql('ALTER TABLE playlist_media_media DROP FOREIGN KEY FK_50F8E392EA9FDD75');
        $this->addSql('ALTER TABLE playlist_media_playlist DROP FOREIGN KEY FK_63FEBFA717421B18');
        $this->addSql('ALTER TABLE playlist_media_playlist DROP FOREIGN KEY FK_63FEBFA76BBD148');
        $this->addSql('DROP TABLE playlist_media');
        $this->addSql('DROP TABLE playlist_media_media');
        $this->addSql('DROP TABLE playlist_media_playlist');
    }
}
