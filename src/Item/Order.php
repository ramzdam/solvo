<?php
namespace Item;

use Item\ElectronicItem\Television as Television;
use Item\ElectronicItem\Microwave as Microwave;
use Item\ElectronicItem\Controller as Controller;
use Item\ElectronicItem\ElectronicItem as ElectronicItem;
use Item\ElectronicItem\Console as Console;

class Order
{

	private $ordered_items = [];
	public $order_type = "Main";
	public function __construct($is_main = true)
	{
		if ($is_main) {
			$this->order_type = ElectronicItem::ORDER_TYPE_MAIN;
		} else {
			$this->order_type = ElectronicItem::ORDER_TYPE_EXTRA;
		}		
	}

	public function canMakeExtra($item)
	{
		
		if ($item->maxExtras() ) {
			return "Max extra have been reached";
		}
	}

	public function makeDefinedOrder()
	{
		$orders = [];

		$console = $this->createConsole();
		$remote_controller1 = $this->createController(ElectronicItem::REMOTE_TYPE);
		$remote_controller2 = $this->createController(ElectronicItem::REMOTE_TYPE);
		$wired_controller1 = $this->createController(ElectronicItem::WIRED_TYPE);
		$wired_controller2 = $this->createController(ElectronicItem::WIRED_TYPE);
		$console->setExtras($remote_controller1);
		$console->setExtras($remote_controller2);
		$console->setExtras($wired_controller1);
		$console->setExtras($wired_controller2);

		$tv1 = $this->createTelevision();
		$tv1_remote_controller1 = $this->createController(ElectronicItem::REMOTE_TYPE);
		$tv1_remote_controller2 = $this->createController(ElectronicItem::REMOTE_TYPE);
		$tv1->setExtras($tv1_remote_controller1);
		$tv1->setExtras($tv1_remote_controller2);

		$tv2 = $this->createTelevision();
		$tv2_remote_controller1 = $this->createController(ElectronicItem::REMOTE_TYPE);
		$tv2->setExtras($tv2_remote_controller1);

		$orders[] = $console;
		$orders[] = $tv1;
		$orders[] = $tv2;

		return $orders;
	}

	public function makeOrder()
	{
		echo "==================================================
Please select the item you want to order?\n\n
[1] Console
[2] Controller
[3] Microwave
[4] Television
==================================================\n";
		$order_num = readline("Enter your order:");
		
		switch($order_num) {
			case 1:
				return $this->createConsole();
				break;

			case 2:
				// Controller
			$type = readline("Please select the type of controller you want?:
[1] Remote Controller
[2] Wired Controller\n
Enter your choice: ");
				$type_controller = ElectronicItem::WIRED_TYPE;
				if ($type == 1) {
					$type_controller = ElectronicItem::REMOTE_TYPE;	
				}

				return $this->createController($type_controller);
				break;

			case 3:
				// Microwave
				return $this->createMicrowave();
				break;

			case 4:
				// Television				
				return $this->createTelevision();				
				break;

			default:
				echo "Order canceled!";				
		}
	}

	public function createConsole()
	{
		$min = 10000;
		$max = 60000;
		
		$price = mt_rand ($min*10, $max*10) / 10;
		$name = "Console #";
		return new Console($name, $price);		
	}

	public function createController($type)
	{
		$min = 10000;
		$max = 60000;
		
		$price = mt_rand ($min*10, $max*10) / 10;
		$name = "Controller #";		

		return new Controller($name, $price, $type);
		
	}

	public function createMicrowave()
	{
		$min = 10000;
		$max = 60000;
		
		$price = mt_rand ($min*10, $max*10) / 10;
		$name = "Microwave #";

		return new Microwave($name, $price);
	}

	public function createTelevision()
	{
		$min = 10000;
		$max = 60000;
		
		$price = mt_rand ($min*10, $max*10) / 10;
		$name = "Television #";

		return new Television($name, $price);
	}
}