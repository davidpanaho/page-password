<?php
/**
 * Page Password plugin for Craft CMS 3.x
 *
 * A simple plugin that allows you to password protect a page.
 *
 * @link      https://www.davidpanaho.com
 * @copyright Copyright (c) 2018 David Panaho
 */

namespace davidpanaho\pagepassword\variables;

use davidpanaho\pagepassword\PagePassword;

use Craft;

/**
 * @author    David Panaho
 * @package   PagePassword
 * @since     0.1.0
 */
class PagePasswordVariable
{
    // Public Methods
    // =========================================================================

    public function accessGranted()
    {
        $cookie = md5('pagePasswordAccess');
        return array_key_exists($cookie, $_COOKIE);
    }
}
