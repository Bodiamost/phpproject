<?php 
class Field {
	private $name;
	private $message = '';
	private $hasError = false;

	public function __construct($name, $message='')
    {

		$this->name=$name;
		$this->message=$message;
    }
    public function getName()
    {
    	return $this->name;
    }
    public function getMessage()
    {
    	return $this->message;
    }
    public function hasError()
    {
    	return $this->hasError;
    }
    public function setErrorMessage($message)
    {
    	$this->message=$message;
    	$this->hasError=true;
    }
    public function clearErrorMessage()
    {
    	$this->message='';
    	$this->hasError=false;
    }
    public function getHTML()
    {
    	$message=htmlspecialchars($this->message);
    	if($this->hasError())
    	{
    		return '<span class="error">'.$message.'</span>';
    	}
    	else 
    	{
			return '<span>'.$message.'</span>';
    	}  	
    }
}
class Fields
{
	private $fields = array();

	public function addField($name,$message='')
	{

		
		$field = new Field($name,$message);
		$this->fields[$field->getName()]=$field;
	}
	public function getField($name)
	{
		return $this->fields[$name];
	}
	public function hasErrors()
	{
		foreach ($this->fields as $field) 
		{
			if ($field->hasError()) {
			  	return true;
			}
		}
		return false;
	}
}
class Validate
{
	private $fields;

	function __construct()
	{
		$this->fields = new Fields();
	}
	public function getFields()
	{
		return $this->fields;
	}

	public function text($name,$value,$required = true,$min = 1,$max = 255) 
	{
		// Get Field object
		$field = $this->fields->getField($name) ;
		// If not required and empty, clear errors

		if (!$required && empty($value)) {
			$field—>clearErrorMessage();
			return;
		}

		// Cheek field and set or clear error message
		if ($required && empty($value)) {
		$field->setErrorMessage('Required.');
		} else if (strlen($value) < $min) {
		$field->setErrorMessage('Too short.');
		} else if (strlen($value) > $max) {
		$field->setErrorMessage('Too long.');
		} else {$field->clearErrorMessage(); }
	}
	public function pattern($name, $value, $pattern, $message, $required = true) 
	{
		// Get Field object
		$field = $this->fields->getField($name) ;

		// If not required and alipty, clear errors
		if (!$required && empty($value)) {
			$field->c1earErrorMessage() ;
			return;
		}
		// Check field and set or clear error message
		$match = preg_match($pattern, $value);
		if ($match === false) {
			$field->setErrorMessage('Error testing field.') ;
		} else if ( $match != 1 ) {
			$field->setErrorMessage($message);
		} else {
			$field->clearErrorMessage();
		}
	}
	public function phone($name, $value, $required = false) 
	{
		// Get Field object
		$field = $this->fields->getField($name) ;

		// Call the text method_exists(object, method_name)
		// and exit if it yields an error
		$this->text($name,$value,$required);
		if ($field->hasError()) {return;}

		// Call the pattern method
		// to validate a phone number
		$patten = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
		$message = 'Invalid phone number';
		$this->pattern($name,$value,$pattern,$message,$required);		
	}
	//need fix
	public function email($name, $value, $required = false) 
	{
		// Get Field object
		$field = $this->fields->getField($name) ;

		// If not required and alipty, clear errors
		if (!$required && empty($value)) {
			$field->c1earErrorMessage() ;
			return;
		}
		// Call the text method
		// and exit if it yields an error
		$this->text($name,$value,$required);
		if ($field->hasError()) {return;}
		$parts=explode('@', $value);
		if(count($parts)<2){
			$field->setErrorMessage('At sign required.');
			return;
		}
		if(count($parts)>2){
			$field->setErrorMessage('Only one sign allowed.');
			return;
		}
		$local=$parts[0];
		$domain=$parts[1];
		if(strlen($local)>64){
			$field->setErrorMessage('Username too long.');
			return;
		}		
		if(strlen($domain)>255){
			$field->setErrorMessage('Domain name part too long.');
			return;
		}	
		$atom = '[[:alnum:]_!#$%&\'*+\/=?^{|}~-]+';
		$dotatom = '(\.'.$atom.')*';
		$address = '(^'.$atom.$dotatom.'$)';

		$char = '([^\\\\"])';
		$esc = '(\\\\[\\\\"])';
		$text = '('.$char.'|'.$esc.')+';
		$quoted = '(^"'.$text.'"$)';

		$localPattern='/'.$address.'|'.$quoted.'/';
		// Call the pattern method
		$message = 'Invalid username part';
		$this->pattern($name,$local,$localPattern,$message);
		if ($field->hasError()) {return;}	

		$hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
		$hostnames = '('.$hostname.'(\.'.$hostname.')*)';
		$top = '\.[[:alnum:]]{2,6}';

		$domainPattern='/^'.$hostnames.$top.'$/'; 
		$message = 'Invalid domain name part';
		$this->pattern($name,$domain,$domainPattern,$message);	
	}
}
?>