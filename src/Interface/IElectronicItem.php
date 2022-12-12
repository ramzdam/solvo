<?php
namespace Interface;
use Item\ElectronicItem\ElectronicItem;

interface IElectronicItem {
	// public function getExtras():int;
	// public function setExtras(ElectronicItem $item);
	// public function maxExtras():bool;
	public function setName(string $name);
	public function getName();
	public function setPrice($price);
	public function getPrice();	
	public function setCurrency(string $currency);
	public function getCurrency();
	public function getGroupType();	
}