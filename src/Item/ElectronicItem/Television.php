<?php
namespace Item\ElectronicItem;

use Interface\IConfigurable;
use Trait\Purchase;

/**
 * Class Television child of ElectronicItem class.
 * Implements IConfigurable which allows the ElectronicItem to set Extras
 */
class Television extends ElectronicItem implements IConfigurable
{
	use Purchase;	
	public const ALLOWED_EXTRA = -1;
	public const ELECTRONIC_GROUP_TYPE = "television";
	protected $type = ElectronicItem::WIRED_TYPE;

	public function __construct($name, $price, $type = ElectronicItem::WIRED_TYPE)
	{
		parent::__construct($name, $price, self::ELECTRONIC_GROUP_TYPE, $type);
	}
}