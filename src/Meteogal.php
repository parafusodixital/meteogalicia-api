<?php
namespace ParafusoDixital/MeteogaliciaAPI;

class Meteogal
{
	private $_id;
	private $_idStation;
	private $_data;
	private $_variable;
	private $_units;
	private $_value;
	private $_validationCode;
	
	public function __construct($id, $idStation, $data, $variable, $units, $value, $validationCode)
	{
		$this->_id = $id;
		$this->_idStation = $idStation;
		$this->_data = $data;
		$this->_variable = $variable;
		$this->_units = $units;
		$this->_value = $value;
		$this->_validationCode = $validationCode;
	}

	public function getData() 
	{ 
		return $this->_data; 
	}
	
	public function getVariable() 
	{ 
		return $this->_variable; 
	}
	
	public function getUnits() 
	{ 
		return $this->_units; 
	}
	
	public function getValue() 
	{ 
		return $this->_value; 
	}
	
	public function getValidationCode() 
	{ 
		return $this->_validationCode; 
	}
	
	public function __toString()
	{
		return
			"[METEOGAL] = " .
				"Id: $this->_id; IdStation: $this->_idStation; " .
				"Data: $this->_data; Variable: $this->_variable; " .
				"Units: $this->_units; Value: $this->_value; " .
				"ValidationCode: $this->_validationCode";
	}
}
