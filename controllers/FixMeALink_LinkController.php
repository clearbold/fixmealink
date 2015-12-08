<?php
namespace Craft;

class FixMeALink_LinkController extends BaseController
{
    //protected $allowAnonymous = array('followLink');

    public function actionFollowLink($hash)
    {
        // TODO: Make this conditional based on an asset match
        $assetLink = craft()->fixMeALink->getAssetLink($hash);

        $data = file_get_contents($assetLink);

        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment;filename=" . craft()->fixMeALink->getAssetName($hash));

        echo $data; exit;

        // Else redirect to the URL
        $this->redirect(craft()->fixMeALink->getLink($hash), $terminate = true);
    }
}
