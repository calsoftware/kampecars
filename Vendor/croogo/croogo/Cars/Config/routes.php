<?php
Router::connect('/', array('plugin'=>'cars','controller' => 'cars', 'action' => 'index'));
Router::connect('/inventory', array('plugin'=>'cars','controller' => 'Inventory', 'action' => 'index'));
Router::connect('/inventory/*', array('plugin'=>'cars','controller' => 'Inventory', 'action' => 'display'));
Router::connect('/services', array('plugin'=>'cars','controller' => 'Services', 'action' => 'index'));
