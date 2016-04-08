<?php

namespace Craft;

class FixMeALinkService extends BaseApplicationComponent
{
    public function __construct()
    {

    }

    public function cleanUpStaleLinks()
    {
        craft()->db->createCommand()->delete('fixmealink_links', 'TIME_TO_SEC(TIMEDIFF(UTC_TIMESTAMP(), dateCreated)) > 15*60');
    }

    public function getAssetLink($hash)
    {
        $row = craft()->db->createCommand(array(
            'select' => array('link'),
            'from' => 'fixmealink_links',
            'where' => 'hash=:hash and asset_id IS NOT NULL',
            'params' => array(':hash'=>$hash),
        ))->queryRow();

        return $row['link'];
    }

    public function getAssetId($hash)
    {
        $row = craft()->db->createCommand(array(
            'select' => array('asset_id'),
            'from' => 'fixmealink_links',
            'where' => 'hash=:hash and asset_id IS NOT NULL',
            'params' => array(':hash'=>$hash),
        ))->queryRow();

        return $row['asset_id'];
    }

    public function getAssetName($hash)
    {
        $asset_id = craft()->fixMeALink->getAssetId($hash);

        $assets = craft()->elements->getCriteria(ElementType::Asset);
        $assets->id = $asset_id;
        $assets->limit = 1;
        $asset_name = 'file';
        foreach ($assets as $assetMatched)
            $asset_name = $assetMatched->filename;

        return $asset_name;
    }

    public function getLink($hash)
    {
        $row = craft()->db->createCommand(array(
            'select' => array('link'),
            'from' => 'fixmealink_links',
            'where' => 'hash=:hash',
            'params' => array(':hash'=>$hash),
        ))->queryRow();

        if ( !$row )
            return '404';
        else
            return $row['link'];
    }

    public function saveLink($str)
    {
        $hash = md5($str);
        craft()->db->createCommand()->insert('fixmealink_links', array(
            'hash'=>$hash,
            'link'=>$str
        ));

        return $hash;
    }

    public function saveAssetLink($asset)
    {
        // TODO: Need to validate that this is in fact an asset

        $hash = md5($asset->url);
        craft()->db->createCommand()->insert('fixmealink_links', array(
            'hash'=>$hash,
            'link'=>$asset->url,
            'asset_id'=>$asset->id
        ));

        return $hash;
    }
}
