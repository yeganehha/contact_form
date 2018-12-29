<?php

/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/28/2018
 * Time: 4:26 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/28/2018 - 4:26 PM
 * Discription of this Page :
 */


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


class validate {
	private $data ;
	private $error = array() ;
	private $returnData ;
	private $isValid ;
	private $methodExploder = '__';

	/**
	 * Validate constructor.
	 *
	 * validation  : required , notEmpty , email , number , numberFormat [ include { } / X 0123456789 + . - ] , maxLen [number] , minLen [number]
 	 * @return boolean
	 *
	 * @param array $data
	 * @param array $validations
	 */
	public function __construct(array  $data, array $validations) {
		$this->isValid = true ;
		$this->returnData = null ;
		try {
			$this->data = $data;
			$this->error = null ;
			foreach ($validations as $paramsName => $validationsParameters) {
				$validationsParametersEachOne = null ;
				if ( !isset($data[$paramsName]))
					break ;

				if ( strpos( $validationsParameters , '|' ) ){
					$validationsParametersEachOne = explode('|',$validationsParameters);
				}
				else {
					$validationsParametersEachOne[] = $validationsParameters ;
				}
				foreach ( $validationsParametersEachOne as $validateType ){
					$validateTypeParameter = null ;
					$strpose = strpos($validateType,':');
					if ( $strpose !== false){
						$validateTypeParameter = substr($validateType , $strpose+1 );
						$validateType = substr($validateType,0,$strpose);
					}
					$validateType = $this->methodExploder.$validateType ;
					if( method_exists($this,$validateType)){
						if ( ! $this->{$validateType}($paramsName , $data[$paramsName] ,$validateTypeParameter ) )
							$this->isValid = false ;
					} else
						$this->isValid = false ;
				}
			}
		} catch ( \Exception $e) {
			$this->error = $e->getMessage() ;
			$this->isValid = false ;
			return false ;
		}
		return $this->isValid ;
	}


	/**
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * @return array
	 */
	public function getReturnData() {
		return $this->returnData;
	}

	/**
	 * @return bool
	 */
	public function isValid() {
		return $this->isValid;
	}

	/**
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __minLen($paramsName , $paramsValue , $paramsValidateType ){
		if ( strlen($paramsValue) < $paramsValidateType ) {
			$this->error[] = array('name' => $paramsName , 'type' => 'minLen' , 'params' => $paramsValidateType );
			return false ;
		}
		$this->returnData[$paramsName] = $paramsValue;
		return true ;
	}

	/**
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __maxLen($paramsName , $paramsValue , $paramsValidateType ){
		if ( strlen($paramsValue) > $paramsValidateType ) {
			$this->error[] = array('name' => $paramsName , 'type' => 'maxLen' , 'params' => $paramsValidateType );
			return false ;
		}
		$this->returnData[$paramsName] = $paramsValue;
		return true ;
	}

	/**
	 * $paramsValidateType include { } / X 0123456789 + . -
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __numberFormat($paramsName , $paramsValue , $paramsValidateType ){
		$num_a=array('0','1','2','3','4','5','6','7','8','9');
		$key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
		$paramsValue = str_replace($key_a,$num_a,$paramsValue);
		if ( $paramsValue == '' ) {
			$this->returnData[$paramsName] = $paramsValue;
			return true;
		}
		$explodeAccolade = preg_split("/{|}/", $paramsValidateType);
		$correctGroupWords = array();
		if ( count($explodeAccolade) >  0 ) {
			foreach ($explodeAccolade as $indexWord => $valueOfWord) {
				if (strpos($valueOfWord, '/') === false) {
					if (count($correctGroupWords) > 0) {
						foreach ($correctGroupWords as $indexOfGroupWord => $valueOfGroupWords) {
							$correctGroupWords[$indexOfGroupWord] .= $valueOfWord;
						}
					} else {
						$correctGroupWords[] = $valueOfWord;
					}
				} else {
					$explodedWord = explode('/', $valueOfWord);
					$newCorrectGroupWords = array();
					foreach ($explodedWord as $numberOfExplodedWord => $oneOfThem) {
						if (count($correctGroupWords) > 0) {
							foreach ($correctGroupWords as $indexOfGroupWord => $valueOfGroupWords) {
								$newCorrectGroupWords[] = $valueOfGroupWords . $oneOfThem;
							}
						} else {
							$newCorrectGroupWords[] = $oneOfThem;
						}
					}
					if (count($correctGroupWords) > 0) {
						foreach ($correctGroupWords as $indexOfGroupWord => $valueOfGroupWords) {
							unset($correctGroupWords[$indexOfGroupWord]);
						}
					}
					$correctGroupWords = array_merge($correctGroupWords, $newCorrectGroupWords);
				}
			}
		} else
			$correctGroupWords[] = $paramsValidateType ;
		usort($correctGroupWords, function($a, $b) {
			return strlen($a) - strlen($b);
		});
		foreach ( $correctGroupWords as $indexOfWord => $correctWord ){
			if ( strlen($paramsValue) == strlen($correctWord)) {
				$return = true ;
				for ($i = 0; $i < strlen($paramsValue); $i++) {
					if ( substr($correctWord,$i,1) != 'X' ) {
						if (substr($paramsValue, $i, 1) != substr($correctWord, $i, 1)) {
							$return = false ;
							break;
						}
					} else {
						if ( ! ( ( intval(substr($paramsValue,2,1)) > 0 and intval(substr($paramsValue,2,1)) < 10 ) or substr($paramsValue,2,1) == '0' ) ){
							$return = false ;
							break;
						}
					}
				}
				if ( $return ) {
					$this->returnData[$paramsName] = $paramsValue;
					return true;
				}
			}
		}
		$this->error[] = array('name' => $paramsName, 'type' => 'numberFormat', 'params' => $paramsValidateType);
		return false;
	}


	/**
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __email($paramsName , $paramsValue , $paramsValidateType ){
		if ( ! filter_var($paramsValue, FILTER_VALIDATE_EMAIL) and $paramsValue != '' ) {
			$this->error[] = array('name' => $paramsName , 'type' => 'email' , 'params' => '' );
			return false ;
		}
		$this->returnData[$paramsName] = $paramsValue;
		return true ;
	}

	/**
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __required($paramsName , $paramsValue , $paramsValidateType ){
		if ( $paramsValue == null ) {
			$this->error[] = array('name' => $paramsName , 'type' => 'required' , 'params' => '' );
			return false ;
		}
		$this->returnData[$paramsName] = $paramsValue;
		return true ;
	}

	/**
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __notEmpty($paramsName , $paramsValue , $paramsValidateType ){
		if ( ( ( empty($paramsValue) and $paramsValue != '0' ) or $paramsValue == '' ) or $paramsValue == null  ) {
			$this->error[] = array('name' => $paramsName , 'type' => 'notEmpty' , 'params' => '' );
			return false ;
		}
		$this->returnData[$paramsName] = $paramsValue;
		return true ;
	}

	/**
	 * @param $paramsName
	 * @param $paramsValue
	 * @param $paramsValidateType
	 *
	 * @return bool
	 */
	private function __number($paramsName , $paramsValue , $paramsValidateType ){
		$intParamsValue = intval($paramsValue) + 1 ;
		$intParamsValue = $intParamsValue - 1;
		if ( $intParamsValue !=  $paramsValue ) {
			$this->error[] = array('name' => $paramsName , 'type' => 'notEmpty' , 'params' => '' );
			return false ;
		}
		$this->returnData[$paramsName] = $paramsValue;
		return true ;
	}


}