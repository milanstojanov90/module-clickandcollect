<?php

namespace MageClass\ClickAndCollect\Setup;

use MageClass\ClickAndCollect\Model\Store;
use MageClass\ClickAndCollect\Model\StoreFactory;
use MageClass\ClickAndCollect\Api\StoreRepositoryInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class InstallData implements InstallDataInterface
{
	/**
     * Store factory
     *
     * @var StoreFactory
     */
    protected $storeFactory;

    /**
     * Store repository
     *
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     *
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * Init
     *
     * @param StoreFactory $storeFactory
     */
    public function __construct(
        StoreFactory $storeFactory,
        StoreRepositoryInterface $storeRepository,
        DateTime $date
    ) {
        $this->storeFactory = $storeFactory;
        $this->storeRepository = $storeRepository;
        $this->date = $date;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
    	$dataSet = [
    		[
    			'name' => 'Countdown Newmarket',
    			'address' => '277 Cnr Broadway & Morrow Streets 
Newmarket Auckland',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-36.87053600000000',
                'longitude' => '174.77736500000000',
                'is_active' => 1
    		],
            [
                'name' => 'Countdown Browns Bay',
                'address' => 'Cnr Anzac & Clyde Roads
Browns Bay
Auckland',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-36.71655900000000',
                'longitude' => '174.74788000000000',
                'is_active' => 1
            ],
            [
                'name' => 'Countdown Waiheke Island',
                'address' => '13-19 Belgium Street
Waiheke Island',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-36.79625400000000',
                'longitude' => '175.04601300000000',
                'is_active' => 1
            ],
            [
                'name' => '76 Quay Street
Auckland City',
                'address' => '76 Quay Street
Auckland City',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-36.84522100000000',
                'longitude' => '174.77293900000000',
                'is_active' => 1
            ],
            [
                'name' => 'Countdown Whitianga',
                'address' => '24 Joan Gaskell Drive
Whitianga',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-36.83480400000000',
                'longitude' => '175.69873900000000',
                'is_active' => 1
            ],
            [
                'name' => 'Countdown Greerton',
                'address' => '1368 Cameron Road
Tauranga',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-37.72748000000000',
                'longitude' => '176.13206100000000',
                'is_active' => 1
            ],
            [
                'name' => 'Countdown Nelson',
                'address' => '35 St Vincent Street
Nelson',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-41.27283400000000',
                'longitude' => '173.27742200000000',
                'is_active' => 1
            ],
            [
                'name' => 'Countdown Church Corner',
                'address' => 'Cnr Riccarton Road & Hansons Lane
Riccarton
Christchurch',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-43.53177500000000',
                'longitude' => '172.57370900000000',
                'is_active' => 1
            ],
            [
                'name' => 'Countdown Hornby',
                'address' => '17 Chappie Place
Hornby
Christchurch 8042',
                'working_time' => 'Monday: 7am - 10pm
Tuesday: 7am - 10pm
Wednesday: 7am - 10pm
Thursday: 7am - 10pm
Friday: 7am - 10pm
Saturday: 7am - 10pm
Sunday: CLOSED',
                'latitude' => '-43.54251400000000',
                'longitude' => '172.52731300000000',
                'is_active' => 1
            ]
    	];

    	foreach ($dataSet as $data) {
    		$store = $this->storeFactory->create();
            $store->setData($data);
            $this->storeRepository->save($store);
        }
    }
}