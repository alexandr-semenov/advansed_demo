<?php

namespace backend\controllers;

use backend\models\Customer\Dto\CustomerDto;
use backend\models\Customer\Service\CustomerService;
use backend\utils\TransformData\TransformDataInterface;
use Psr\Log\LoggerInterface;
use yii\web\Controller;
use yii\web\Request;

/**
 * Class CustomerController
 */
class CustomerController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TransformDataInterface
     */
    private $transformData;

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * SiteController constructor.
     * @param $id
     * @param $module
     * @param TransformDataInterface $transformData
     * @param CustomerService $customerService
     * @param LoggerInterface $logger
     * @param array $config
     */
    public function __construct(
        $id,
        $module,
        TransformDataInterface $transformData,
        CustomerService $customerService,
        LoggerInterface $logger,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->logger = $logger;
        $this->transformData = $transformData;
        $this->customerService = $customerService;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->logger->info('log message from Index Customer controller');
        return "customer controller index action";
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function actionCreateFromArray(Request $request)
    {
        $dto = $this->transformData->transform($request, CustomerDto::class);

        $name = $this->customerService->showCustomerName($dto);
        $customer = $this->customerService->createCustomer($dto);

        $this->logger->info('log message from Create Customer controller');

        return 'customer controller post action';
    }

    public function actionCreateFromJson(Request $request)
    {
        $raw = $request->getRawBody();

        return "customer controller post action";
    }
}
