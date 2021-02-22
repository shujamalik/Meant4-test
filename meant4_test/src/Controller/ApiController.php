<?php
namespace Drupal\meant4_test\Controller;
use Drupal\Core\Controller\ControllerBase;

class ApiController extends ControllerBase {
    public function getWeatherdata($city = null,$country_code = null) {
		$client = \Drupal::httpClient();
		$config = \Drupal::config('meant4_test.config');
		if($city == null){
			$city = $config->get('default_city');
		}
		if($country_code == null){
			$country_code = $config->get('default_country_code');
		}
		
		$response = $client->get($config->get('Apiendpoint').$city.','.$country_code.'&appid='.$config->get('ApiKey'),array('http_errors' => FALSE));
		$data = $response->getBody();
		$weather_data = json_decode($data);
		
		return [
		  '#theme' => 'meant4_weather_data',      
		  '#weather_data' => $weather_data,
		];
    }
}
