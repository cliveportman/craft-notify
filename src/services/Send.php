<?php
/**
 * Notify plugin for Craft CMS 3.x
 *
 * Send a notification from a template
 *
 * @link      https://clive.theportman.co
 * @copyright Copyright (c) 2019 Clive Portman
 */

namespace portman\notify\services;

use portman\notify\Notify;

use Craft;
use craft\base\Component;
use craft\mail\Message;

/**
 * Send Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Clive Portman
 * @package   Notify
 * @since     0.0.1
 */
class Send extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Notify::$plugin->send->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'Hello';

        return $result;
    }


    /**
     * @param $html
     * @param $subject
     * @param null $mail
     * @param array $attachments
     * @return bool
     */
    public function sendMail($email = null, $subject, $body, array $attachments = array()): bool
    {

        // $file = Craft::getAlias('@storage/logs/notify.log');
        // $error = 'sendMail called debug';
        // $log = date('Y-m-d H:i:s').' ['.$error."]\n";
        // \craft\helpers\FileHelper::writeToFile($file, $log, ['append' => true]);

        $settings = Craft::$app->systemSettings->getSettings('email');
        $message = new Message();

        $message->setFrom([$settings['fromEmail'] => $settings['fromName']]);
        $message->setTo($email);
        $message->setSubject($subject);
        $message->setHtmlBody($body);
        if (!empty($attachments) && \is_array($attachments)) {

            foreach ($attachments as $fileId) {
                if ($file = Craft::$app->assets->getAssetById((int)$fileId)) {
                    $message->attach($this->getFolderPath() . '/' . $file->filename, array(
                        'fileName' => $file->title . '.' . $file->getExtension()
                    ));
                }
            }
        }

        return Craft::$app->mailer->send($message);
    }

}
