<?php
namespace ParafusoDixital/MeteogaliciaAPI;

class MeteogalJSON
{
	private $_url;
	private $_json;

	public function __construct($url)
	{
		$this->_url = $url;
	}
	
	public function getJSON($est, $param, $hoursNumber)
	{
		$ch = curl_init();
		$params = array(
			"idEst" => $est,
			"idParam" => $param,
			"numHoras" => $hoursNumber
		);
		$paramsurl = "";
		foreach($params as $key => $value)
		{
			$paramsurl .= "$key=$value&";
		}
		$paramsurl = trim($paramsurl, "&");
		
		curl_setopt($ch, CURLOPT_URL, "$this->_url?$paramsurl" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$this->_json = curl_exec($ch);
		curl_close($ch);
	}

	public function getDataFromVariable($variable)
	{
		$results = array();
		if (($aux = json_decode($this->_json, TRUE)) == TRUE)
		{
			$data = $aux['listHorarios'][0]['listaInstantes'];
			foreach($data as $values)
			{
				$dataRead = $values['listaMedidas'][0];
				if (strcasecmp($dataRead['nomeParametro'], $variable) == 0)
				{
					$results[] = new Meteogal(NULL, $aux['listHorarios'][0]['idEstacion'], $values['instanteLecturaUTC'], $variable, $dataRead['unidade'],
						str_replace(',', '.', $dataRead['valor']), $dataRead['lnCodigoValidacion']);
				}
			}
		}
		return $results;
	}
}
