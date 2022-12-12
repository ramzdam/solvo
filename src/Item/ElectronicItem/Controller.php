<?php
namespace Item\ElectronicItem;

use Interface\IConfigurable;
use Trait\Purchase;

class Controller extends ElectronicItem implements IConfigurable
{
	use Purchase;
	public const ALLOWED_EXTRA = 0;
	public const ELECTRONIC_GROUP_TYPE = "controller";
	protected $type = ElectronicItem::WIRED_TYPE;

	public function __construct($name, $price, $type = ElectronicItem::WIRED_TYPE)
	{
		parent::__construct($name, $price, self::ELECTRONIC_GROUP_TYPE, $type);
	}
}