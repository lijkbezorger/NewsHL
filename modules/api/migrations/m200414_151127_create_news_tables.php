<?php

use yii\db\Migration;

/**
 * Class m200414_151127_create_news_tables
 */
class m200414_151127_create_news_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string(100),
            'isActive'  => $this->boolean()->defaultValue(false),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer(),
        ], $this->getTableOptions());

        $this->createTable('{{%post}}', [
            'id'          => $this->primaryKey(),
            'content'     => $this->text(),
            'preview'     => $this->string(),
            'isPublished' => $this->boolean()->defaultValue(false),
            'publishedAt' => $this->integer(),
            'categoryId'  => $this->integer()->null(),
            'createdAt'   => $this->integer(),
            'updatedAt'   => $this->integer(),
        ], $this->getTableOptions());

        $this->addForeignKey(
            'post-category-fk',
            '{{%post}}',
            'categoryId',
            '{{%category}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('post-category-fk', '{{%post}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%category}}');

        return true;
    }

    private function getTableOptions($tableOptions = null)
    {
        if ((\Yii::$app->db->driverName === 'mysql') && ($tableOptions === null)) {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        return $tableOptions;
    }
}
