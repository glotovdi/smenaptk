<?php
class Server
{
	public $type;
	public $ip;
	public $space;
	public $host_cpu;
	public $CPUs;
	public $OS;
	public $software;
	public $EKESPP;
	public $hostName;
	function __construct($type,$ip,$space,$host_cpu,$CPUs,$OS,$software,$EKESPP,$hostName)
	{
		$this->type = $type;
		$this->ip = $ip;
		$this->space = $space;
		$this->host_cpu = $host_cpu;
		$this->CPUs = $CPUs;
		$this->OS = $OS;
		$this->software = $software;
		$this->EKESPP = $EKESPP;
		$this->hostName = $hostName;
	}
}
?>