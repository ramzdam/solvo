<?php
namespace Item\ElectronicItem;

use Interface\IElectronicItem;
use \Exception;

class ElectronicItem implements IElectronicItem
{	
	private $name;
	private $price;
	private $currency = "PHP";
	private $type;
	private $group_type;
	protected int $allowed_extras;
	public $extras = [];
	const ORDER_TYPE_MAIN = "main";
	const ORDER_TYPE_EXTRA = "extra";
	const WIRED_TYPE = "wired";
	const REMOTE_TYPE = "remote";

	public function __construct($name, $price, $group_type, $type = ElectronicItem::WIRED_TYPE)
	{
		$this->setName($name);
		$this->setPrice($price);
		$this->setType($type);
		$this->setCurrency("PHP");
		$this->group_type = $group_type;
	}

	public function setName(string $name)
	{
		$this->name = $name;		
	}

	public function getName()
	{
		return $this->name;
	}

	public function setPrice($price)
	{
		if (!$price) {
			$this->price = 0;
			return;
		}

		$this->price = $price;		
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setCurrency(string $currency)
	{
		$this->currency = $currency;		
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	public function getPrice()
	{
		return $this->price;
	}
	public function getGroupType() 
	{
		return $this->group_type;
	}

	public function getExtras()
	{
		return $this->extras;	
	}

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

	public function setExtras(ElectronicItem $item)
	{
		if (!$item) {
			return;
		}

		$this->extras[] = $item;		
	}

	public function resetExtras(iterable $item) {
		$this->extras = $item;
	}
}