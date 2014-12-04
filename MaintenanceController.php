<?php
/**
 * Default controller of maintenance mode component for Yii framework 2.0
 * @author Brusenskiy Dmitry <brussens@nativeweb.ru>
 */

namespace brussens\maintenance;

/**
 * Class MaintenanceController
 * @package brussens\maintenance
 */
class MaintenanceController extends \yii\web\Controller {
    /**
     * @return string
     */
    public function actionIndex() {
        return $this->renderFile(\Yii::$app->maintenanceMode->viewPath);
    }
} 