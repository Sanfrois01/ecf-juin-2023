<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413074701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaire_reservation_reservation (horaire_reservation_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_8DCC35EE9A25E124 (horaire_reservation_id), INDEX IDX_8DCC35EEB83297E7 (reservation_id), PRIMARY KEY(horaire_reservation_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE horaire_reservation_reservation ADD CONSTRAINT FK_8DCC35EE9A25E124 FOREIGN KEY (horaire_reservation_id) REFERENCES horaire_reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_reservation_reservation ADD CONSTRAINT FK_8DCC35EEB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaire_reservation_reservation DROP FOREIGN KEY FK_8DCC35EE9A25E124');
        $this->addSql('ALTER TABLE horaire_reservation_reservation DROP FOREIGN KEY FK_8DCC35EEB83297E7');
        $this->addSql('DROP TABLE horaire_reservation_reservation');
    }
}
