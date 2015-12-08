<?php
namespace Craft;

class FixMeALink_LinkRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'fixmealink_links';
    }

    protected function defineAttributes()
    {
        return array(
            'hash' => AttributeType::String,
            'link' => AttributeType::String,
            'asset_id' => AttributeType::Number
        );
    }
}
