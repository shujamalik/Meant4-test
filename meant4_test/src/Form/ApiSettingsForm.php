<?php
/**
 * @file
 * Contains Drupal\meant4_test\Form\ApiSettingsForm
*/

namespace Drupal\meant4_test\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 *  Sweden Settings 
 * Configure settings for this site.
 */
class ApiSettingsForm extends ConfigFormBase {
	
	 /**
	* {@inheritdoc}
	*/
	public function getFormId() {
	return 'ApiSettingsForm';
	}

	/**
	* {@inheritdoc}
	*/
	protected function getEditableConfigNames() {
	return [
	'meant4_test.config',
	];
	}

	/**
	* {@inheritdoc}
	*/
	public function buildForm(array $form, FormStateInterface $form_state) {
	$config = $this->config('meant4_test.config');
	 $form['meant4_test'] = array(
	  '#type' => 'details',
	  '#title' => $this->t('Settings'),
	  '#description' => $this->t(''),
	  '#open' => TRUE, 
	);
	$form['meant4_test']['settings'] = $this->config_form($config);
	return parent::buildForm($form, $form_state);
	}  

	//Patient Information form.
	protected function config_form($config) {
		
		$form['Apiendpoint'] = array(
		  '#type' => 'textfield',
		  '#title' => $this->t('API Endpoint'),
		  '#default_value' => $config->get('Apiendpoint'),		  
		  '#description' => $this->t('Url for weather Api'),
		);
		
		$form['ApiKey'] = array(
		  '#type' => 'textfield',
		  '#title' => $this->t('Api Key'),
		  '#default_value' => $config->get('ApiKey'),		  
		  '#description' => $this->t('Api Key for weather Api'),
		);
		
		$form['default_city'] = array(
		  '#type' => 'textfield',
		  '#title' => $this->t('Default City'),
		  '#default_value' => $config->get('default_city'),		  
		  '#description' => $this->t('Default city for weather api'),
		);

		$form['default_country_code'] = array(
		  '#type' => 'textfield',
		  '#title' => $this->t('Default Country Code'),
		  '#default_value' => $config->get('default_country_code'),		  
		  '#description' => $this->t('Default country for weather api'),
		);
		
	  return $form;
	}

	/**
	* {@inheritdoc}
	*/
	public function submitForm(array &$form, FormStateInterface $form_state) {
		// Retrieve the configuration
		$this->config('meant4_test.config')		
		->set('Apiendpoint', $form_state->getValue('Apiendpoint'))
		->set('ApiKey', $form_state->getValue('ApiKey'))
		->set('default_city', $form_state->getValue('default_city'))
		->set('default_country_code', $form_state->getValue('default_country_code'))
		->save();

		parent::submitForm($form, $form_state); 
	}  
}	