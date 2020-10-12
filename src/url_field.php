<?php
/**
 * Field accepts URL like
 * 	* http://www.domain.com/
 * 	* https://www.domain.com/
 * 	* www.domain.com
 */
class UrlField extends RegexField{
	function __construct($options = array()){
		$auth_token = '[a-zA-Z0-9%]';
		parent::__construct('/^(?<proto>https?:\/\/|)(?<basic_auth>'.$auth_token.'*:'.$auth_token.'*@|)[a-z0-9._-]+(|:[0-9]{1,6})(?<port>\/.*|)$/i',$options);
		$this->update_messages(array(
			"invalid" => _("This doesn't look like an URL"),
		));
	}

	/**
	 * This is RegexField`s hook method beeing called atomatically after a successful pattern matching.
	 */
	function processResult($value, $matches){
		if($matches["proto"]==""){
			$value = "http://$value";
		}
		if($matches["port"]==""){
			$value = "$value/";
		}
		return array(null, $value);
	}
}
