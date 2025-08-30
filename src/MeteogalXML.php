<?php
namespace ParafusoDixital/MeteogaliciaAPI;

class MeteogalXML
{
	private $_url;
	private $_xml;
	
	public function __construct($url)
	{
		$this->_url = $url;
	}
	
	public function getXML($est, $param, $data1, $data2, $idprov, $red)
	{
		$ch = curl_init();
		$params = array(
			"est" => $est,
			"param" => $param,
			"data1" => $data1,
			"data2" => $data2,
			"idprov" => $idprov,
			"red" => $red
		);
		$paramsurl = "";
		foreach($params as $key => $value)
		{
			$paramsurl .= "$key=$value&";
		}
		$paramsurl = trim($paramsurl, "&");
		
		curl_setopt($ch, CURLOPT_URL, "$this->_url?$paramsurl" );
		echo "{$this->_url}?{$paramsurl}"; exit(0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$this->_xml = curl_exec($ch);
		curl_close($ch);
	}
	
	public function getDataFromVariable($variable)
	{
		$results = array();
		if ($this->_xml != "")
		{
			$data = new SimpleXMLElement($this->_xml);
			foreach($data->Valores as $values)
			{
				$dataRead = $values->Medida;
				if (strcasecmp($dataRead['Variable'], $variable) == 0)
				{
					$results[] = new Meteogal($dataRead['ID'], $data['ID'], $values['Data'], $variable, $dataRead['Unidades'],
						str_replace(',', '.', $dataRead['Valor']), $dataRead['Codigo_validacion']);
				}
			}
		}
		return $results;
	}
}
