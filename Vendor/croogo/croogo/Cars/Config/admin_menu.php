<?php
CroogoNav::add ( 'sidebar', 'cars_magt', array (
		'icon' => 'book',
		'title' => __d ( 'croogo', 'Car Inventory Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'cars',
				'action' => 'index' 
		),
		'weight' => 0,
		'children' => array (
				'car_inventory' => array (
						'title' => __d ( 'croogo', 'Car Inventory' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'cars',
								'action' => 'inventory' 
						),
						'weight' => 0 
				),
				'car_make' => array (
						'title' => __d ( 'croogo', 'Car Make' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'cars',
								'action' => 'make' 
						),
						'weight' => 0 
				),
				'car_model' => array (
						'title' => __d ( 'croogo', 'Car Model' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'cars',
								'action' => 'model' 
						),
						'weight' => 0 
				),
				'car_extras' => array (
						'title' => __d ( 'croogo', 'Car Extras' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'cars',
								'action' => 'extras' 
						),
						'weight' => 0 
				),
				'car_setup' => array (
						'title' => __d ( 'croogo', 'Car Features Setup' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'cars',
								'action' => 'features_setup' 
						),
						'weight' => 0 
				) 
		)
		 
) );

CroogoNav::add ( 'sidebar', 'SupplierManagement', array (
		'icon' => 'edit',
		'title' => __d ( 'croogo', 'Supplier Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'suppliers',
				'action' => 'index' 
		),
		'weight' => 1,
		'children' => array (
				'SupplierDetails' => array (
						'title' => __d ( 'croogo', 'Supplier Details' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'suppliers',
								'action' => 'list' 
						),
						'weight' => 0 
				) 
		) 
) );

CroogoNav::add ( 'sidebar', 'ServicesManagement', array (
		'icon' => 'sitemap',
		'title' => __d ( 'croogo', 'Services Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'services',
				'action' => 'index' 
		),
		'weight' => 2,
		'children' => array (
				'RoadAssistance' => array (
						'title' => __d ( 'croogo', 'Road Assistance & Recovery' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'services',
								'action' => 'road_assistance' 
						),
						'weight' => 0 
				),
				'MOTBooking' => array (
						'title' => __d ( 'croogo', 'MOT Booking' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'services',
								'action' => 'mot_booking' 
						),
						'weight' => 0 
				),
				'CarBodyRepairs' => array (
						'title' => __d ( 'croogo', 'Car Body Repairs' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'services',
								'action' => 'cbr' 
						),
						'weight' => 0 
				) 
		) 
) );

CroogoNav::add ( 'sidebar', 'PurchasesManagement', array (
		'icon' => 'sitemap',
		'title' => __d ( 'croogo', 'Purchases Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'purchases',
				'action' => 'index' 
		),
		'weight' => 3,
		'children' => array (
				'Purchases Entry' => array (
						'title' => __d ( 'croogo', 'Purchases Entry' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'Purchases',
								'action' => 'index' 
						),
						'weight' => 0 
				) 
		)
		 
) );

CroogoNav::add ( 'sidebar', 'SalesManagement', array (
		'icon' => 'sitemap',
		'title' => __d ( 'croogo', 'Sales Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'sales',
				'action' => 'index' 
		),
		'weight' => 4,
		'children' => array (
				'SalesEntry' => array (
						'title' => __d ( 'croogo', 'Sales Entry' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'cars',
								'controller' => 'sales',
								'action' => 'index' 
						),
						'weight' => 0 
				) 
		)
		 
) );
CroogoNav::add ( 'sidebar', 'UserManagement', array (
		'icon' => 'sitemap',
		'title' => __d ( 'croogo', 'User Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'users',
				'controller' => 'users',
				'action' => 'index' 
		),
		'weight' => 5,
		'children' => array (
				'UserSetup' => array (
						'title' => __d ( 'croogo', 'User Setup' ),
						'url' => array (
								'admin' => true,
								'plugin' => 'users',
								'controller' => 'users',
								'action' => 'index' 
						),
						'weight' => 0 
				) 
		) 
) );
 


CroogoNav::add ( 'sidebar', 'ReportManagement', array (
		'icon' => 'sitemap',
		'title' => __d ( 'croogo', 'Report Management' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'reports',
				'action' => 'index' 
		),
		'weight' => 6,
		'children' => array () 
) );

CroogoNav::add ( 'sidebar', 'Miscellaneous', array (
		'icon' => 'sitemap',
		'title' => __d ( 'croogo', 'Miscellaneous' ),
		'url' => array (
				'admin' => true,
				'plugin' => 'cars',
				'controller' => 'miscellaneous',
				'action' => 'index' 
		),
		'weight' => 7,
		'children' => array () 
) );