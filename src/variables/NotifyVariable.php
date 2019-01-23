<?php
/**
 * Notify plugin for Craft CMS 3.x
 *
 * Send a notification from a template
 *
 * @link      https://clive.theportman.co
 * @copyright Copyright (c) 2019 Clive Portman
 */

namespace portman\notify\variables;

use portman\notify\Notify;

use Craft;

/**
 * Notify Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.notify }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Clive Portman
 * @package   Notify
 * @since     0.0.1
 */
class NotifyVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.notify.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.notify.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        // $result = "And away we go to the Twig template...";
        // if ($optional) {
        //     $result = "I'm feeling optional today..." . $optional;
        // }
        $result = Notify::$plugin->send->exampleService();
        return $result;
    }

    public function sendEmail($email, $subject, $body)
    {

        if (Notify::$plugin->send->sendMail($email, $subject, $body)) return true;
        
        return false;
    }

}
