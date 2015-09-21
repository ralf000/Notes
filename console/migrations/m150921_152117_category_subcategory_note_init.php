<?php

use yii\db\Schema;
use yii\db\Migration;

class m150921_152117_category_subcategory_note_init extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `Category` (
         `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
         `Category` VARCHAR(255) NULL COMMENT '',
         `created_at` INT NULL COMMENT '',
         `updated_at` INT NULL COMMENT '',
         PRIMARY KEY (`id`) COMMENT '')
         ENGINE = InnoDB;");
        
        $this->execute("CREATE TABLE IF NOT EXISTS `Subcategory` (
         `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
         `Subcategory` VARCHAR(45) NULL COMMENT '',
         `created_at` INT NULL COMMENT '',
         `updated_at` INT NULL COMMENT '',
         `Category_id` INT NOT NULL COMMENT '',
         PRIMARY KEY (`id`, `Category_id`) COMMENT '',
         INDEX `fk_Subcategory_Category1_idx` (`Category_id` ASC) COMMENT '',
         CONSTRAINT `fk_Subcategory_Category1`
         FOREIGN KEY (`Category_id`)
         REFERENCES `Category` (`id`)
         ON DELETE NO ACTION
         ON UPDATE NO ACTION)
         ENGINE = InnoDB;");
        
        $this->execute("CREATE TABLE IF NOT EXISTS `Note` (
         `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
         `title` VARCHAR(255) NULL COMMENT '',
         `content` TEXT NULL COMMENT '',
         `anchors` TEXT NULL COMMENT '',
         `created_at` INT NULL COMMENT '',
         `updated_at` INT NULL COMMENT '',
         `Subcategory_id` INT NOT NULL COMMENT '',
         PRIMARY KEY (`id`, `Subcategory_id`) COMMENT '',
         INDEX `fk_Note_Subcategory1_idx` (`Subcategory_id` ASC) COMMENT '',
         CONSTRAINT `fk_Note_Subcategory1`
         FOREIGN KEY (`Subcategory_id`)
         REFERENCES `Subcategory` (`id`)
         ON DELETE NO ACTION
         ON UPDATE NO ACTION)
         ENGINE = InnoDB;");
    }

    public function down()
    {
        $this->dropTable('category');
        $this->dropTable('subcategory');
        $this->dropTable('note');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
