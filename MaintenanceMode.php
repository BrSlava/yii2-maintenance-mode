<?php

/**
 * Maintenance mode component for Yii framework 2.0
 * @author Brusenskiy Dmitry <brussens@nativeweb.ru>
 */

namespace brussens\maintenance;
use yii\helpers\Html;

/**
 *
 * Class MaintenanceMode
 * @package brussens\maintenance
 */
class MaintenanceMode extends \yii\base\Component {
    /**
     *
     * Mode status
     *
     * @var bool
     */
    public $enabled = true;

    /**
     * Route to action
     *
     * @var string
     */
    public $route = 'maintenance/index';

    /**
     * Show message
     *
     * @var null
     */
    public $message = null;

    /**
     * Allowed user names
     *
     * @var array
     */
    public $users = ['admin'];

    /**
     * Allowed roles
     * @var array
     */
    public $roles = [''];

    /**
     * Allowed IP addresses
     *
     * @var array
     */
    public $ips = [];

    /**
     * Allowed urls
     *
     * @var array
     */
    public $urls = [];

    /**
     * Path to view file
     *
     * @var string
     */
    public $viewPath = '@vendor/brussens/yii2-maintenance-mode/views/index.php';

    /**
     * Username attribute name
     *
     * @var string
     */
    public $usernameAttribute = 'username';

    /**
     * init method
     */
    public function init() {

        if(!$this->message) {

            $this->message = 'Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always ';
            $this->message .= Html::mailto('contact us', (\Yii::$app->params['adminEmail'] ? \Yii::$app->params['adminEmail'] : '#'));
            $this->message.= ', otherwise we&rsquo;ll be back online shortly!';
        }
        if ($this->enabled) {
            if (!\Yii::$app->user->isGuest) {
                $disable = in_array(\Yii::$app->user->identity->{$this->usernameAttribute}, $this->users);
            } else {
                $disable = false;
            }
        if (!$this->roles) {
                foreach ($this->roles as $role) {
                    $disable = $disable || \Yii::$app->user->can($role);
                }
        }
            $disable = $disable || in_array(\Yii::$app->request->getPathInfo(), $this->urls);
            $disable = $disable || in_array(\Yii::$app->request->userIP, $this->ips);
            if (!$disable) {
                if ($this->route === 'maintenance/index') {
                    \Yii::$app->controllerMap['maintenance'] = '\brussens\maintenance\MaintenanceController';
                }
                \Yii::$app->catchAll = [$this->route];
            }
        }
    }
}
