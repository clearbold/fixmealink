<?php

namespace Craft;

class FixMeALinkPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('Fix Me a Link');
    }

    function getVersion()
    {
        return '0.1';
    }

    function getDeveloper()
    {
        return 'Mark Reeves';
    }

    function getDeveloperUrl()
    {
        return 'http://clearbold.com';
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.fixmealink.twigextensions.FixMeALinkTwigExtension');
        return new FixMeALinkTwigExtension;
    }
}
