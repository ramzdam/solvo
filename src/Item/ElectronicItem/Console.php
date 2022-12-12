<?php
namespace Item\ElectronicItem;

use Interface\IConfigurable;
use Trait\Purchase;

/**
 * Class Console child of ElectronicItem class.
 * Implements IConfigurable which allows the ElectronicItem to set Extras
 */
class Console extends ElectronicItem implements IConfigurable
{
	use Purchase;
	public const ALLOWED_EXTRA = 4;
	public const ELECTRONIC_GROUP_TYPE = "console";
	protected $type = ElectronicItem::WIRED_TYPE;

	public function __construct($name, $price, $type = ElectronicItem::WIRED_TYPE)
	{
		parent::__construct($name, $price, self::ELECTRONIC_GROUP_TYPE, $type);
	}
}