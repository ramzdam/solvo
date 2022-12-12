<?php

require './src/bootstrap.php';

use Item\Order as Order;
use Item\ElectronicItem\ElectronicItem as ElectronicItem;
use Item\ElectronicItem\Console as Console;

init();

function init()
{
	$choice = readline("What question number would you like to see the answer?
[1] Proceed to first question
[2] Proceed to second question
[any key] To quit
Enter your choice: ");

	if (strtolower($choice) == 1) {
		questionOne();
	} elseif (strtolower($choice) == 2) {
		questionTwo();
	}
}

/**
 * Output the question one result
 * 
 * @return display via command line
 */
function questionOne()
{
	$orders = [];

	$choice = readline("Would you like to manually insert order? Press Y to manual order or any key if you like to auto generate predefined order: ");

	if (strtolower($choice) != 'y') {
		$order_item = new Order(true);
		$orders = $order_item->makeDefinedOrder();
	} else {
		$create_order = readline("Would you like to make an order? Press Y for yes any key otherwise: ");
		while(strtolower($create_order) == "y") {
			$order = new Order(true);
			$order_item = $order->makeOrder();		
			$order_item = setExtraOrderItem($order_item);
			$orders[] = $order_item;
			$create_order = readline("Would you like to make another order? Press Y for yes any key otherwise: ");
		}
	}

	$orders = sortOrders($orders);
	// print_r($orders);
	outputOrders($orders);
}

/**
 * Output the question two result
 * 
 * @return display via command line
 */
function questionTwo()
{
	$orders = [];

	$order_item = new Order(true);
	$orders = $order_item->makeDefinedOrder();

	$orders = sortOrders($orders);	
	outputInquiries($orders, Console::ELECTRONIC_GROUP_TYPE);
}

/**
 * Output the result for question two
 * 
 * @param $orders array()<ElectronicItem>
 */
function outputInquiries($orders, $inquiry_type = Console::ELECTRONIC_GROUP_TYPE) 
{
	$total = 0;
	echo "********************************************\n
Order Summary
********************************************\n";
	if ($orders) {
		echo "Ordered Items      | Price\n";
		foreach($orders as $order)
		{
			if ($order->getGroupType() != $inquiry_type) {
				continue;
			}

			echo $order->getName() . "          | " . $order->getCurrency() . " " . $order->getPrice() . " [" . $order->getGroupType() . "]" . "\n";
			$total += $order->getPrice();
			$extras = $order->getExtras();

			if (!$extras) {
				continue;
			}
			echo "       -----------------\n";
			echo "       Extras\n";
			echo "       -----------------\n";
			foreach($order->getExtras() as $extra) {
				$total += $extra->getPrice();
				echo "       " . $extra->getName() . " (" . $extra->getType() . ")          | " . $extra->getCurrency() . " " . $extra->getPrice() . "\n";
			}
		}

		echo "=========================================\n";
		echo "Total: " . $total . "\n";
		echo "=========================================\n";
	}
}

/**
 * Ouput the orders for question one
 * 
 * @param $orders array()<ElectronicItem>
 */
function outputOrders($orders)
{
	$total = 0;
	echo "********************************************\n
Order Summary
********************************************\n";
	if ($orders) {
		echo "Ordered Items           | Price\n";
		foreach($orders as $order)
		{
			echo $order->getName() . "          | " . $order->getCurrency() . " " . $order->getPrice() . " [" . $order->getGroupType() . "]" . "\n";
			$total += $order->getPrice();
			$extras = $order->getExtras();

			if (!$extras) {
				continue;
			}
			echo "       -----------------\n";
			echo "       Extras\n";
			echo "       -----------------\n";
			foreach($order->getExtras() as $extra) {
				$total += $extra->getPrice();
				echo "       " . $extra->getName() . " (" . $extra->getType() . ")          | " . $extra->getCurrency() . " " . $extra->getPrice() . "\n";
			}
		}

		echo "=========================================\n";
		echo "Total: " . $total . "\n";
		echo "=========================================\n";
	}

}


/**
 * Sort the generated orders into a ascending order
 * 
 * @param $orders array()<ElectronicItem>
 */
function sortOrders($orders) {
	$new_orders = $orders;

	usort($new_orders, function($a, $b) {		
		return strcmp($a->getPrice(), $b->getPrice());
	});

	foreach($new_orders as &$order) {
		$extras = $order->getExtras();
		usort($extras, function($a, $b) {		
			return strcmp($a->getPrice(), $b->getPrice());
		});

		$order->resetExtras($extras);
	}

	return $new_orders;
}

/**
 * Set the extras for each order set
 * 
 * @param $order_item Item\ElectronicItem\ElectronicItem
 * @return Item\ElectronicItem\ElectronicItem
 */
function setExtraOrderItem($order_item)
{
	$choice= readline("Would you like to add extra to the item " . $order_item->getName() . "? Press Y for yes any key otherwise: ");

	if (strtolower($choice) != 'y') {		
		return $order_item;
	}
	$add_extra = true;

	while($add_extra) {
		try {			
			if (!$order_item->maxExtras($order_item::ALLOWED_EXTRA)) {
				$order = new Order(false);
				$order_extra = $order->makeOrder();				
				$order_item->setExtras($order_extra);
			}		

			$choice = readline("Would you like to add another extra to the item " . $order_item->getName() . "? Press Y for yes any key otherwise: ");

			if (strtolower($choice) != "y") {
				$add_extra = false;
				break;
			}
		} catch(\Exception $e) {
			echo $e->getMessage();
			$add_extra = false;
		}		
	}

	return $order_item;
}