<?php
declare(strict_types = 1);

namespace backend\controllers;

use backend\components\Booking\BookingInterface;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @var BookingInterface
     */
    private $booking;

    /**
     * SiteController constructor.
     * @param $id
     * @param $module
     * @param BookingInterface $booking
     * @param array $config
     */
    public function __construct($id, $module, BookingInterface $booking, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->booking = $booking;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     *
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $db = Yii::$app->db;

        $model = $this->booking->serialize([
            'id' => '1',
            'age' => 54,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john_doe@mail.com',
            'phone' => '+44178956322',
        ]);

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
