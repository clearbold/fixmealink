<?php
/**
 * @link      https://github.com/clearbold/craft-fixmealink
 * @copyright Copyright (c) Clearbold, LLC
 */

namespace clearbold\fixmealink;

use craft\base\Plugin;
use clearbold\fixmealink\twig\TwigExtensions;

/**
 * CmTransactionalAdapter implements a Campaign Monitor Transactional Email transport adapter into Craft’s mailer.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */
class Fixmealink extends Plugin
{

    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        $this->setComponents([
            'fixmealink' => \clearbold\fixmealink\services\FixmealinkService::class,
        ]);

        self::$plugin = $this;
        self::$plugin->view->twig->addExtension(new TwigExtensions());
        \Craft::info(
            \Craft::t('fixmealink', '{name} plugin loaded', [
                'name' => $this->name
            ]),
            __METHOD__
        );
    }
}
