<?php
namespace Trait;

use Item\ElectronicItem;

trait Purchase 
{
	public function addExtra(ElectronicItem $item)
	{
		if ($this->maxExtras())
		{
			echo "Can't add anymore extra item for this Electronic";
			return;
		}

		$this->setExtras($item);
	}
}