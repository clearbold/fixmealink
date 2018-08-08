<?php
/**
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */

namespace clearbold\fixmealink\records;

use craft\db\ActiveRecord;

/**
 * EntryCountRecord
 *
 * @property int         $id                         ID
 * @property string      $link                       Link
 * @property string      $hash                       Hash
 * @property int         $assetId                    Asset ID
 */
class FixmealinkRecord extends ActiveRecord
{
    // Public Static Methods
    // =========================================================================

     /**
     * @inheritdoc
     *
     * @return string the table name
     */
    public static function tableName(): string
    {
        return '{{%fixmealink_links}}';
    }
}