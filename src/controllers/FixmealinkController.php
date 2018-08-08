<?php
/**
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */

namespace clearbold\fixmealink\controllers;

use Craft;
use craft\web\Controller;
use clearbold\fixmealink\Fixmealink;

/**
 * EntryCountController
 */
class FixmealinkController extends Controller
{
    /**
     * Reset count
     */
    public function actionFollowLink($hash)
    {
        if ( Fixmealink::getInstance()->fixmealink->getLink($hash) == '404' ) {
            return $this->renderTemplate('404');
        }
        elseif ( Fixmealink::getInstance()->fixmealink->getAssetId($hash) == 0 ) {
            return $this->redirect(Fixmealink::getInstance()->fixmealink->getLink($hash), 307);
        }
        else {
            // $assetLink = Fixmealink::getInstance()->fixmealink->getAssetLink($hash);
            // $data = file_get_contents($assetLink);
            // header("Content-type: application/octet-stream");
            // header("Content-disposition: attachment;filename=" . craft()->fixMeALink->getAssetName($hash));
            // echo $data; exit;
        }
    }
}