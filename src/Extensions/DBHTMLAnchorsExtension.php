<?php

namespace Fromholdio\DBHTMLAnchors\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Parsers\ShortcodeParser;

class DBHTMLAnchorsExtension extends Extension
{
    public function getAnchors()
    {
        $content = ShortcodeParser::get_active()->parse($this->getOwner()->value);

        if (
            $content &&
            preg_match_all(
                "/\\s+(name|id)\\s*=\\s*([\"'])([^\\2\\s>]*?)\\2|\\s+(name|id)\\s*=\\s*([^\"']+)[\\s +>]/im",
                $content,
                $matches
            )
        ) {
            $anchors = array_values(
                array_unique(
                    array_filter(
                        array_merge($matches[3], $matches[5])
                    )
                )
            );
            return array_combine($anchors, $anchors);
        }
        return null;
    }
}
