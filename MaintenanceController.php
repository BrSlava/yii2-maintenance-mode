<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 04.12.2014
 * Time: 3:53
 */

namespace brussens\maintenance;

class MaintenanceController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }
} 