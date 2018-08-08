<?php
/**
 * @link      https://github.com/clearbold/craft-fixmealink
 * @copyright Copyright (c) Clearbold, LLC
 */

namespace clearbold\fixmealink\migrations;

use Craft;
use craft\db\Migration;

/**
 * Fix Me a Link Install Migration
 */
class Install extends Migration
{
    // Public Methods
    // =========================================================================

    /**
     * @return boolean
     */
    public function safeUp(): bool
    {
        if (!$this->db->tableExists('{{%fixmealink_links}}')) {
            $this->createTable('{{%fixmealink_links}}', [
                'id' => $this->primaryKey(),
                'hash' => $this->string()->notNull(),
                'link' => $this->string()->notNull(),
                'assetId' => $this->integer()->defaultValue(0),
                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid' => $this->uid(),
            ]);

            // Refresh the db schema caches
            Craft::$app->db->schema->refresh();
        }

        return true;
    }

    /**
     * @return boolean
     * @throws \Throwable
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists('{{%fixmealink_links}}');

        return true;
    }
}