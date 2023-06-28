<?php

namespace App\Traits;

trait SocialLinksTrait
{
    public $social_links_validateable = true;

    public $social_links_patterns = [
        'facebook'  => '^(?:http(?:s)?:\/\/)?(?:www\.)?facebook\.com\/([a-zA-Z0-9._-]+)$',
        'instagram' => '^(?:http(?:s)?:\/\/)?(?:www\.)?instagram\.com\/([a-zA-Z0-9._-]+)$',
        'twitter'   => '^(?:http(?:s)?:\/\/)?(?:www\.)?twitter\.com\/([a-zA-Z0-9._-]+)$',
        'linkedin'  => '^(?:http(?:s)?:\/\/)?(?:www\.)?linkedin\.com\/in\/([a-zA-Z0-9_\-]+)$',
    ];

    public function socialLinkPattern($social)
    {
        if ($this->social_links_validateable && isset($this->social_links_patterns[$social])) {
            return '/' . $this->social_links_patterns[$social] . '/';
        }
    }
}
