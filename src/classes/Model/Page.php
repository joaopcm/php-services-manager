<?php

namespace Sourcess\Model;

use Rain\Tpl;

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header" => true,
		"footer" => true,
		"data" => []
	];

	public function __construct($opts = array(), $tpl_dir = "/views/site/")
	{
		$this->options = array_merge($this->defaults, $opts);
		$cache_dir = "/tmp/";
		// Descomente a linha abaixo caso o ambiente de desenvolvimento seja Windows
		// $cache_dir = ON_PRODUCTION === 'false' ? $_SERVER['DOCUMENT_ROOT'] . "/views/cache/" : "/tmp/";
		$config = array(
		    "base_url"      => null,
			"tpl_dir"       => $_SERVER['DOCUMENT_ROOT'] . $tpl_dir,
			"cache_dir"		=> $cache_dir,
		    "debug"         => false
		);
		Tpl::configure($config);
		$this->tpl = new Tpl();
		if ($this->options['data']) $this->setData($this->options['data']);
		if ($this->options['header'] === true) $this->tpl->draw("header", false);
	}

	public function __destruct()
	{
		if ($this->options['footer'] === true) $this->tpl->draw("footer", false);
	}

	private function setData($data = array())
	{
		foreach($data as $key => $val)
		{
			$this->tpl->assign($key, $val);
		}
	}

	public function setTpl($tplname, $data = array(), $returnHTML = false)
	{
		$this->setData($data);
		return $this->tpl->draw($tplname, $returnHTML);
	}

}

?>