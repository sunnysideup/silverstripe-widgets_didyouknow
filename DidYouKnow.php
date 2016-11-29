<?php
/**
 *@author nicolaas [at] sunnysideup.co.nz
 **/
class DidYouKnow extends Widget
{
    public static $db = array(
        "WidgetTitle" => "Varchar(50)"
    );

    public static $title = 'Did You Know?';

    public static $cmsTitle = 'Did You Know?';

    public static $description = 'Allows you to add a random Did you know....? statement.';

    public function getCMSFields()
    {
        return new FieldSet(
            new TextField("WidgetTitle", "Title (optional)"),
            new TableField(
                $name = "DidYouKnow",
                $sourceClass = "DidYouKnow_Statement",
                $fieldList = array("Content" => "Content"),
                $fieldTypes = array("Content" => "TextField")
            )
        );
    }

    public function Title()
    {
        return $this->WidgetTitle ? $this->WidgetTitle : self::$title;
    }

    public function getTitle()
    {
        return $this->Title;
    }

    public function RandomDidYouKnowItem()
    {
        Requirements::themedCSS("widgets_didyouknow");
        $do = DataObject::get_one("DidYouKnow_Statement", null, $cache = true, "RAND() DESC");
        if ($do) {
            return $do->Content;
        }
    }
}

class DidYouKnow_Statement extends DataObject
{
    public static $db = array(
        "Content" => "Varchar(255)"
    );
}
