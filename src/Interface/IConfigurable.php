<?php
namespace Interface;
use Item\ElectronicItem\ElectronicItem;

interface IConfigurable {
	public function maxExtras();
	public function setExtras(ElectronicItem $item);
	public function resetExtras(iterable $item);
	public function getExtras();
}