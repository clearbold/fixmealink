<?php
/**
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */

namespace clearbold\fixemalink\models;

use craft\base\Model;

/**
 * EntryCountModel
 */
class FixmealinkModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var int|null ID
     */
    public $id;

    /**
     * @var string
     */
    public $link;

    /**
     * @var string
     */
    public $hash;

    /**
     * @var \DateTime|null Date created
     */
    public $dateCreated;

    /**
     * @var \DateTime|null Date updated
     */
    public $dateUpdated;

    // Public Methods
    // =========================================================================

    /**
     * Define what is returned when model is converted to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->hash;
    }
}