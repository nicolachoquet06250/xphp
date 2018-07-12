<?php

class xphp_tag {
	protected $attributs = [];
	protected $value = '';
	private $models = [];
    private $views = [];
    private $services = [];

    public function __construct($models, $views, $services) {
        $this->models = $models;
        $this->views = $views;
        $this->services = $services;
    }

    public function attribute($name=null, $value=null) {
		if(is_null($value)) {
			if(is_null($name)) {
				return $this->attributs;
			}
			return isset($this->attributs[$name]) ? $this->attributs[$name] : null;
		}

		if((substr($value, 0, 1) === '"' || substr($value, 0, 1) === "'" )
		   && (substr($value, strlen($value)-1, 1) === '"' || substr($value, strlen($value)-1, 1) === "'" )) {
			$value = substr($value, 1, strlen($value));
			$value = substr($value, 0, strlen($value)-1);
		}

		$value = str_replace('%20', ' ', $value);
		$this->attributs[$name] = $value;
		return $this;
	}

	public function value($value = null) {
		if(is_null($value)) {
			return $this->value;
		}
		if((substr($value, 0, 1) === '"' || substr($value, 0, 1) === "'" )
		   && (substr($value, strlen($value)-1, 1) === '"' || substr($value, strlen($value)-1, 1) === "'" )) {
			$value = substr($value, 1, strlen($value));
			$value = substr($value, 0, strlen($value)-1);
		}
		$value = str_replace('%20', ' ', $value);
		$this->value = $value;
		return $this;
	}

	public function render():string {
		return '';
	}

	public function get_class() {
		return __CLASS__;
	}

	protected function get_models() {
	    return array_keys($this->models);
    }

	/**
	 * @param $name
	 * @return model
	 */
    public function get_model($name) {
		$name = "{$name}_model";
        return isset($this->models[$name]) ? $this->models[$name] : null;
    }

    public function get_views() {
	    return array_keys($this->views);
    }

    /**
     * @param $name
     * @return view
     */
    public function get_view($name) {
    	$name = "{$name}_view";
        return isset($this->views[$name]) ? $this->views[$name] : null;
    }

	public function get_services() {
		return array_keys($this->services);
	}

	public function get_service($name) {
		return isset($this->services[$name]) ? $this->services[$name] : null;
	}
}