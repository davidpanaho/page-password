<?php
/**
 * Page Password plugin for Craft CMS 3.x
 *
 * A simple plugin that allows you to password protect a page.
 *
 * @link      https://www.davidpanaho.com
 * @copyright Copyright (c) 2018 David Panaho
 */

namespace davidpanaho\pagepassword\controllers;

use davidpanaho\pagepassword\PagePassword;

use Craft;
use craft\web\Controller;

/**
 * @author    David Panaho
 * @package   PagePassword
 * @since     0.1.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['authorise'];

    public function actionAuthorise()
    {
        $request = Craft::$app->getRequest();
        $password = $request->getBodyParam('password');

        if ($this->passwordIsValid($password)) {
            $expires = time() + (60*60*24*7*2); // Two weeks
            setcookie(md5('pagePasswordAccess'), 1, $expires, '/');
        } else {
            Craft::$app->getSession()->setError('Invalid password - please try again');
        }

        // TODO: Check if this needs to be more secure
        $url = $request->getBodyParam('redirect');

        return $this->redirect($url);
    }

    private function passwordIsValid($password)
    {
        $validPassword = getenv('PAGE_PASSWORD');
        return ($password === $validPassword);
    }
}
