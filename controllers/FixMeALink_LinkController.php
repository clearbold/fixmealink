<?php
namespace Craft;

class FixMeALink_LinkController extends BaseController
{
    //protected $allowAnonymous = array('followLink');

    public function actionFollowLink($hash)
    {
        if ( craft()->fixMeALink->getLink($hash) == '404' )
            $this->renderTemplate('404');
        elseif ( craft()->fixMeALink->getAssetId($hash) == 0 )
            $this->redirect(craft()->fixMeALink->getLink($hash), $terminate = true);
        else {
            $assetLink = craft()->fixMeALink->getAssetLink($hash);

            $data = file_get_contents($assetLink);

            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment;filename=" . craft()->fixMeALink->getAssetName($hash));

            echo $data; exit;
        }
    }
}
