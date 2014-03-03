<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Initial Migration
 * This migration summarizes the changes from a blank DB to the current state of production.
 * It will be our cornerstone to start with.
 */
class Version20130101000000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(255) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Page (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(100) NOT NULL, pagetitle VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_B438191EF47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FF3A7B975E237E06 (name), INDEX IDX_FF3A7B97727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Comment (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, author VARCHAR(100) NOT NULL, email VARCHAR(200) NOT NULL, website VARCHAR(200) DEFAULT NULL, datetime DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_5BC96BF0EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Contribution (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(50) NOT NULL, hostUrl VARCHAR(100) NOT NULL, title VARCHAR(255) NOT NULL, tags VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Feed (id INT AUTO_INCREMENT NOT NULL, feedtype_id INT NOT NULL, mediatype_id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(200) NOT NULL, automaticImport TINYINT(1) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, confirmation VARCHAR(20) NOT NULL, remark LONGTEXT DEFAULT NULL, lastImportedDate DATE DEFAULT NULL, INDEX IDX_8372EB95FE5D1BE4 (feedtype_id), INDEX IDX_8372EB958006F1CE (mediatype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Feedtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, className VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2DAD13E35E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE languageCategory (id INT AUTO_INCREMENT NOT NULL, language_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_2FBF4DBE82F1BAF4 (language_id), INDEX IDX_2FBF4DBE12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Media (id INT AUTO_INCREMENT NOT NULL, mediatype_id INT NOT NULL, date DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, length VARCHAR(10) NOT NULL, title VARCHAR(200) NOT NULL, rating DOUBLE PRECISION NOT NULL, visits INT NOT NULL, content LONGTEXT NOT NULL, slides LONGTEXT DEFAULT NULL, joindin INT DEFAULT NULL, language VARCHAR(2) NOT NULL, slug VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, isImported TINYINT(1) NOT NULL, hostName VARCHAR(255) NOT NULL, hostUrl VARCHAR(255) NOT NULL, thumbnail VARCHAR(250) DEFAULT NULL, creationDate DATE NOT NULL, INDEX IDX_ABED8E088006F1CE (mediatype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE media_language_category (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, languagecategory_id INT NOT NULL, INDEX IDX_3C172C00EA9FDD75 (media_id), INDEX IDX_3C172C0031140687 (languagecategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE media_speaker (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, speaker_id INT NOT NULL, INDEX IDX_1A525D28EA9FDD75 (media_id), INDEX IDX_1A525D28D04A0F27 (speaker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE media_tag (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_48D8C57EEA9FDD75 (media_id), INDEX IDX_48D8C57EBAD26311 (tag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Mediatype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Rating (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, ipaddress VARCHAR(15) NOT NULL, rating INT NOT NULL, INDEX IDX_DF252314EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Speaker (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, photo VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3BC4F1635E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE Category ADD CONSTRAINT FK_FF3A7B97727ACA70 FOREIGN KEY (parent_id) REFERENCES Category (id) ON DELETE SET NULL");
        $this->addSql("ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF0EA9FDD75 FOREIGN KEY (media_id) REFERENCES Media (id)");
        $this->addSql("ALTER TABLE Feed ADD CONSTRAINT FK_8372EB95FE5D1BE4 FOREIGN KEY (feedtype_id) REFERENCES Feedtype (id)");
        $this->addSql("ALTER TABLE Feed ADD CONSTRAINT FK_8372EB958006F1CE FOREIGN KEY (mediatype_id) REFERENCES Mediatype (id)");
        $this->addSql("ALTER TABLE languageCategory ADD CONSTRAINT FK_2FBF4DBE82F1BAF4 FOREIGN KEY (language_id) REFERENCES Language (id)");
        $this->addSql("ALTER TABLE languageCategory ADD CONSTRAINT FK_2FBF4DBE12469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)");
        $this->addSql("ALTER TABLE Media ADD CONSTRAINT FK_ABED8E088006F1CE FOREIGN KEY (mediatype_id) REFERENCES Mediatype (id)");
        $this->addSql("ALTER TABLE media_language_category ADD CONSTRAINT FK_3C172C00EA9FDD75 FOREIGN KEY (media_id) REFERENCES Media (id)");
        $this->addSql("ALTER TABLE media_language_category ADD CONSTRAINT FK_3C172C0031140687 FOREIGN KEY (languagecategory_id) REFERENCES languageCategory (id)");
        $this->addSql("ALTER TABLE media_speaker ADD CONSTRAINT FK_1A525D28EA9FDD75 FOREIGN KEY (media_id) REFERENCES Media (id)");
        $this->addSql("ALTER TABLE media_speaker ADD CONSTRAINT FK_1A525D28D04A0F27 FOREIGN KEY (speaker_id) REFERENCES Speaker (id)");
        $this->addSql("ALTER TABLE media_tag ADD CONSTRAINT FK_48D8C57EEA9FDD75 FOREIGN KEY (media_id) REFERENCES Media (id)");
        $this->addSql("ALTER TABLE media_tag ADD CONSTRAINT FK_48D8C57EBAD26311 FOREIGN KEY (tag_id) REFERENCES Tag (id)");
        $this->addSql("ALTER TABLE Rating ADD CONSTRAINT FK_DF252314EA9FDD75 FOREIGN KEY (media_id) REFERENCES Media (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947");
        $this->addSql("ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395");
        $this->addSql("ALTER TABLE Category DROP FOREIGN KEY FK_FF3A7B97727ACA70");
        $this->addSql("ALTER TABLE languageCategory DROP FOREIGN KEY FK_2FBF4DBE12469DE2");
        $this->addSql("ALTER TABLE Feed DROP FOREIGN KEY FK_8372EB95FE5D1BE4");
        $this->addSql("ALTER TABLE languageCategory DROP FOREIGN KEY FK_2FBF4DBE82F1BAF4");
        $this->addSql("ALTER TABLE media_language_category DROP FOREIGN KEY FK_3C172C0031140687");
        $this->addSql("ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF0EA9FDD75");
        $this->addSql("ALTER TABLE media_language_category DROP FOREIGN KEY FK_3C172C00EA9FDD75");
        $this->addSql("ALTER TABLE media_speaker DROP FOREIGN KEY FK_1A525D28EA9FDD75");
        $this->addSql("ALTER TABLE media_tag DROP FOREIGN KEY FK_48D8C57EEA9FDD75");
        $this->addSql("ALTER TABLE Rating DROP FOREIGN KEY FK_DF252314EA9FDD75");
        $this->addSql("ALTER TABLE Feed DROP FOREIGN KEY FK_8372EB958006F1CE");
        $this->addSql("ALTER TABLE Media DROP FOREIGN KEY FK_ABED8E088006F1CE");
        $this->addSql("ALTER TABLE media_speaker DROP FOREIGN KEY FK_1A525D28D04A0F27");
        $this->addSql("ALTER TABLE media_tag DROP FOREIGN KEY FK_48D8C57EBAD26311");
        $this->addSql("DROP TABLE fos_user_group");
        $this->addSql("DROP TABLE fos_user_user");
        $this->addSql("DROP TABLE fos_user_user_group");
        $this->addSql("DROP TABLE Page");
        $this->addSql("DROP TABLE Category");
        $this->addSql("DROP TABLE Comment");
        $this->addSql("DROP TABLE Contribution");
        $this->addSql("DROP TABLE Feed");
        $this->addSql("DROP TABLE Feedtype");
        $this->addSql("DROP TABLE Language");
        $this->addSql("DROP TABLE languageCategory");
        $this->addSql("DROP TABLE Media");
        $this->addSql("DROP TABLE media_language_category");
        $this->addSql("DROP TABLE media_speaker");
        $this->addSql("DROP TABLE media_tag");
        $this->addSql("DROP TABLE Mediatype");
        $this->addSql("DROP TABLE Rating");
        $this->addSql("DROP TABLE Speaker");
        $this->addSql("DROP TABLE Tag");
    }
}
