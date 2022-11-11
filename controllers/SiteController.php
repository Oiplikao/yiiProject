<?php

namespace app\controllers;

use app\models\business\AssetStarter;
use app\models\page\AssetSingleModel;
use app\models\page\IndexModel;
use app\views\site\assets\AssetHtmlRendererFactory;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new IndexModel();
        $assetHtmlRendererFactory = new AssetHtmlRendererFactory();
        $model->assetTypes = $assetHtmlRendererFactory->getSupportedAssets();
        $model->assets = new ArrayDataProvider([
            'allModels' => AssetStarter::getAssets()
        ]);
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $assets = AssetStarter::getAssets();
        $asset = $assets[$id];
        if(\Yii::$app->request->isPost) {
            $assetHtmlRendererFactory = new AssetHtmlRendererFactory();
            $assetHtmlRenderer = $assetHtmlRendererFactory->getRendererFor($asset);
            $assetHtmlRenderer->fillModel($asset, \Yii::$app->request->post());
        }
        $model = new AssetSingleModel();
        $model->model = $asset;
        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionCreate($assetClass)
    {

    }

    public function actionDelete($id)
    {

    }
}