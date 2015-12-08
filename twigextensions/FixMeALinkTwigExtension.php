<?php

namespace Craft;

class FixMeALinkTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return Craft::t('FixMeALink');
    }

    public function getFilters()
    {
        return array(
            'obfuscate' => new \Twig_Filter_Method($this, 'obfuscate'),
            'obfuscateAssetUrl' => new \Twig_Filter_Method($this, 'obfuscateAssetUrl')
        );
    }

    public function obfuscate($str)
    {
        craft()->fixMeALink->cleanUpStaleLinks();

        $obfuscated_link_hash = craft()->fixMeALink->saveLink($str);

        $obfuscated_link = UrlHelper::getActionUrl('fixMeALink/link/followLink', array('hash' => $obfuscated_link_hash));

        return $obfuscated_link;
    }

    public function obfuscateAssetUrl($asset)
    {
        craft()->fixMeALink->cleanUpStaleLinks();

        $obfuscated_link_hash = craft()->fixMeALink->saveAssetLink($asset);

        $obfuscated_link = UrlHelper::getActionUrl('fixMeALink/link/followLink', array('hash' => $obfuscated_link_hash));

        return $obfuscated_link;
    }
}
