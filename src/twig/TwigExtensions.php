<?php

/**
 * TwigExtensions class
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */

namespace clearbold\fixmealink\twig;

use clearbold\fixmealink\Fixmealink;
use clearbold\fixmealink\services\FixmealinkService;
use craft\helpers\UrlHelper;

class TwigExtensions extends \Twig_Extension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Fix Me a Link';
    }

    /**
     * Makes the filters available to the template context
     *
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('obfuscate', [$this, 'obfuscateFilter']),
            new \Twig_SimpleFilter('obfuscateAssetUrl', [$this, 'obfuscateAssetUrlFilter']),
        ];
    }

    /**
     * @param string $url
     *
     * @return mixed|null|string|string[]
     */
    public function obfuscateFilter(string $url)
    {
        Fixmealink::getInstance()->fixmealink->cleanUpStaleLinks();

        $obfuscated_link_hash = Fixmealink::getInstance()->fixmealink->saveLink($url);

        $obfuscated_link = UrlHelper::actionUrl('fixmealink/fixmealink/follow-link', array('hash' => $obfuscated_link_hash));

        return $obfuscated_link;
    }

    /**
     * @param Asset $url
     *
     * @return mixed|null|string|string[]
     */
    public function obfuscateAssetUrlFilter($asset)
    {
        Fixmealink::getInstance()->fixmealink->cleanUpStaleLinks();

        $obfuscated_link_hash = Fixmealink::getInstance()->fixmealink->saveAssetLink($asset);

        $obfuscated_link = UrlHelper::actionUrl('fixmealink/fixmealink/follow-link', array('hash' => $obfuscated_link_hash));

        return $obfuscated_link;
    }

}