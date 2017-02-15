<?php
	class System{
		public $name;
		public $instruction_url;
		public $name_full;
		public $arm_url;
		public $developer;
		function __construct($name,$instruction_url,$name_full,$arm_url,$developer)
		{
			$this->name = $name;
			$this->instruction_url = $instruction_url;
			$this->name_full = $name_full;
			$this->arm_url = $arm_url;
			$this->developer = $developer;
		}
	}
?>