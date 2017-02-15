<?php
class Administrator
{
	public $name;
	public $work_tel;
	public $mob_tel;
	public $department;
	function __construct($name,$work_tel,$mob_tel,$department)
	{
		$this->name = $name;
		$this->work_tel = $work_tel;
		$this->mob_tel = $mob_tel;
		$this->department = $department;
	}
}
?>