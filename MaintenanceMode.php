<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 04.12.2014
 * Time: 3:34
 */

namespace brussens\maintenance;

class MaintenanceMode extends \yii\base\Component {
    public $enabled = true;
    public $action = 'maintenance/index';

    public $message = "Извините, на сайте ведутся технические работы.";

    public $users = ['admin'];

    public $roles = ['administrator'];

    public $ips = [];

    public $urls = [];

    public function init() {

        if ($this->enabled) {
            $disable = in_array(\Yii::$app->user->name, $this->users);
            foreach ($this->roles as $role) {
                $disable = $disable || \Yii::$app->user->can($role);
            }
            $disable = $disable || in_array(\Yii::$app->request->getPathInfo(), $this->urls);
            $disable = $disable || in_array(\Yii::$app->request->userIP, $this->ips);
            if (!$disable) {
                if ($this->action === 'maintenance/index') {
                    \Yii::$app->controllerMap['maintenance'] = '\brussens\maintenance\MaintenanceController';
                }
                \Yii::$app->catchAll = [$this->action];
            }
        }
    }
} 