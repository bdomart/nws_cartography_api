<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114144404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, geometry_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1FD77566A88A6A72 (geometry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geometry (id INT AUTO_INCREMENT NOT NULL, type_geometry_id INT NOT NULL, coordinates LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_95520EABE393BDE3 (type_geometry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, feature_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, info JSON DEFAULT NULL, INDEX IDX_5E9E89CB60E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_geometry (id INT AUTO_INCREMENT NOT NULL, coordinate_number INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feature ADD CONSTRAINT FK_1FD77566A88A6A72 FOREIGN KEY (geometry_id) REFERENCES geometry (id)');
        $this->addSql('ALTER TABLE geometry ADD CONSTRAINT FK_95520EABE393BDE3 FOREIGN KEY (type_geometry_id) REFERENCES type_geometry (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB60E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB60E4B879');
        $this->addSql('ALTER TABLE feature DROP FOREIGN KEY FK_1FD77566A88A6A72');
        $this->addSql('ALTER TABLE geometry DROP FOREIGN KEY FK_95520EABE393BDE3');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE geometry');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE type_geometry');
    }
}
