<?php
/**
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */

namespace clearbold\fixmealink\services;

use Craft;
use craft\base\Component;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use clearbold\fixmealink\Fixmealink;
use clearbold\fixmealink\models\FixmealinkModel;
use clearbold\fixmealink\records\FixmealinkRecord;
use yii\base\Event;

/**
 * FixmealinkService
 */
class FixmealinkService extends Component
{

    // Public Methods
    // =========================================================================

    public function cleanUpStaleLinks()
    {
        // get records from DB
        $fixmealinkRecords = FixmealinkRecord::find()
            ->where('TIME_TO_SEC(TIMEDIFF(UTC_TIMESTAMP(), dateCreated)) > 15*60')
            ->all();

        // if records exists then delete
        if ($fixmealinkRecords) {
            // delete records from DB
            foreach($fixmealinkRecords as $record)
            {
                $record->delete();
            }
        }
    }

    public function getAssetId($hash)
    {
        $FixmealinkRecord = new FixmealinkRecord();
        // get record from DB
        $FixmealinkRecord = FixmealinkRecord::find()
            ->where(['hash' => $hash])
            ->andWhere('assetId IS NOT NULL')
            ->one();
        if ($FixmealinkRecord) {
            return $FixmealinkRecord->assetId;
        }
        else {
            return 0;
        }
    }

    public function getAssetLink($hash)
    {
        $FixmealinkRecord = new FixmealinkRecord();
        // get record from DB
        $FixmealinkRecord = FixmealinkRecord::find()
            ->where(['hash' => $hash])
            ->andWhere('assetId IS NOT NULL')
            ->one();
        if ($FixmealinkRecord) {
            return $FixmealinkRecord->link;
        }
        else {
            return '404';
        }
    }

    public function getAssetName($hash)
    {
        $FixmealinkRecord = new FixmealinkRecord();
        // get record from DB
        $FixmealinkRecord = FixmealinkRecord::find()
            ->where(['hash' => $hash])
            ->andWhere('assetId IS NOT NULL')
            ->one();
        if ($FixmealinkRecord) {
            return $FixmealinkRecord->assetFilename;
        }
        else {
            return '';
        }
    }

    public function getLink($hash)
    {
        $FixmealinkRecord = new FixmealinkRecord();
        // get record from DB
        $FixmealinkRecord = FixmealinkRecord::find()
            ->where(['hash' => $hash])
            ->one();
        if ($FixmealinkRecord) {
            return $FixmealinkRecord->link;
        }
        else {
            return '404';
        }
    }

    public function saveLink($str)
    {
        $hash = md5($str);
        $fixmealinkRecord = new FixmealinkRecord;
            $fixmealinkRecord->setAttribute('link', $str);
            $fixmealinkRecord->setAttribute('hash', $hash);

        $fixmealinkRecord->save();

        return $hash;
    }

    public function saveAssetLink($asset)
    {
        // TODO: Need to validate that this is in fact an asset
        $hash = md5($asset->url);
        $fixmealinkRecord = new FixmealinkRecord;
            $fixmealinkRecord->setAttribute('link', $asset->url);
            $fixmealinkRecord->setAttribute('hash', $hash);
            $fixmealinkRecord->setAttribute('assetId', $asset->id);
            $fixmealinkRecord->setAttribute('assetFilename', $asset->filename);

        $fixmealinkRecord->save();

        return $hash;
    }

}