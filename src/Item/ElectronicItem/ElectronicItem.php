<?php
namespace Item\ElectronicItem;

use Interface\IElectronicItem;
use \Exception;

class ElectronicItem implements IElectronicItem
{	
	private $name;						// Refer to the name of the electronic item. To identify it
	private $price; 					// The price assigned to the product. Price is set to random
	private $currency = "PHP"; 			// Default of currency will be set to PHP
	private $type; 						// Identify if the ElectronicItem is Wired or Remote
	private $group_type; 				// Identify which type is the electronic item. Ex. Console, Controller, Television, Microwave etc..
	protected int $allowed_extras; 		// The allowed extras to be added to the ElectronicItem
	public $extras = []; 				// List of the ElectronicItem Extras
	const ORDER_TYPE_MAIN = "main"; 	// Identify if the order is main
	const ORDER_TYPE_EXTRA = "extra"; 	// Identify if the order is extra
	const WIRED_TYPE = "wired"; 		// Type of electronic item to be identified as wired
	const REMOTE_TYPE = "remote"; 		// Type of electronic item to be identified as remote

	public function __construct($name, $price, $group_type, $type = ElectronicItem::WIRED_TYPE)
	{
		$this->setName($name);
		$this->setPrice($price);
		$this->setType($type);
		$this->setCurrency("PHP");
		$this->group_type = $group_type;
	}

	/**
	 * Set the name of the ElectronicItem
	 * 
	 * @param $name string
	 */
	public function setName(string $name)
	{
		$this->name = $name;		
	}

	/**
	 * Get the name of the ElectronicItem
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the price of the ElectronicItem. 
	 * If no price is passed value will default to 0
	 * 
	 * @param $price string
	 */
	public function setPrice($price)
	{
		if (!$price) {
			$this->price = 0;
			return;
		}

		$this->price = $price;		
	}

	/**
	 * Get the price of the ElectronicItem. 
	 * 
	 * @return double|int
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Set the type of the ElectronicItem. 
	 * Type is either WIRED or REMOTE
	 * 
	 * @param $type string
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Get the type of the ElectronicItem. 
	 * Type is either WIRED or REMOTE
	 * 
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set the currency of the ElectronicItem. 
	 * Default is set to PHP
	 * 
	 * @param $currency string
	 */
	public function setCurrency(string $currency)
	{
		$this->currency = $currency;		
	}

	/**
	 * Get the type of the ElectronicItem. 
	 * Default is set to PHP
	 * 
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * Get the Electronic Type of the ElectronicItem. 
	 * Type is either console, microwave, television, controller etc...
	 * This is constant that is defined in the child class
	 * 
	 * @return string
	 */
	public function getGroupType() 
	{
		return $this->group_type;
	}

	/**
	 * Set the type of the ElectronicItem. 
	 * Type is either WIRED or REMOTE
	 * 
	 * @param $type string
	 */
	public function getExtras()
	{
		return $this->extras;	
	}

	/**
	 * Identify if the ElectronicItem reached it's maxExtras count
	 * function consider the allowed extra of the child
	 * 
	 * @return bool
	 * @throws \Exception if trying to add extras to ElectronicItem that does not allow any extras
	 *  	   \Exception Throws exception if trying to add extra to ElectronicItem that reached it's allowed extras
	 */
	public function maxExtras($allowed_extra = -1)
	{		
		if ($allowed_extra < 0) {
			return false;
		}

		if ($allowed_extra == 0) {
			throw new Exception("Adding extra to this item is not allowed!\n");
		}

		if (count($this->extras) >= $allowed_extra) {
			throw new Exception("Can't add anymore extra!\n");
		}

		return false;
	}

	/**
	 * Set the Extras to be added to the ElectronicItem.	 
	 * 
	 * @param $item Item\ElectronicItem\ElectronicItem
	 */
	public function setExtras(ElectronicItem $item)
	{
		if (!$item) {
			return;
		}

		$this->extras[] = $item;		
	}

	/**
	 * Set the Extras to be defaulted and overrides whatever extras added to the ElectronicItem
	 * 
	 * @param $item iterable
	 */
	public function resetExtras(iterable $item) {
		$this->extras = $item;
	}
}