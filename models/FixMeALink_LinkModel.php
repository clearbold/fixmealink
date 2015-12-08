<?php
namespace Craft;

class FixMeALink_LinkModel extends BaseModel
{
    // TODO: Let's have one.

    protected function defineAttributes()
    {
        return array(
            'link' => AttributeType::String,
            'hash' => AttributeType::String,
        );
    }
}
