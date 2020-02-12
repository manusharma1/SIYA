<?php date_default_timezone_set('America/New_York'); ?>
<?php
class Config{
  protected $config;
 
    public function __construct()
    {
		if (!defined('ROOT')) {
			define('ROOT', dirname(dirname(dirname(__FILE__))));
		}

		if (!defined('APP_DIR')) {
			define('APP_DIR', basename(dirname(dirname(__FILE__))));
		}	
		
		if(	PHP_OS == "WIN32" || PHP_OS == "WINNT"	)
      		$this->config = parse_ini_file($this->getConfigFilename());
		else
			$this->config = parse_ini_file($this->getConfigFilename());
    }
 
 	public function getConfigDir(){
		if(	PHP_OS == "WIN32" || PHP_OS == "WINNT"	)
			return dirname(__FILE__) . '\\..\\config';
		else
			return dirname(__FILE__) . '/../config'; 
	}
 
 	public function getConfigs(){
		return $this->config;
	}
 
    public function getConfig($key = null)
    {
      if($key !== null)
      {
        if(isset($this->config[$key]))
        {
          return $this->config[$key];
        }
        else
        {
          return null;
        }
      }
      else
      {
        return $this->config;
      }
    }
 
    public function setConfig($config)
    {
      $this->config = $config;
    }
	
	public function getDocUrl(){
		return "<br/><br/>Click <a href='http://flexpaper.devaldi.com/docs_php.jsp'>here</a> for more information on configuring FlexPaper with PHP";
	}
	
	public function getConfigFilename(){
		if(	PHP_OS == "WIN32" || PHP_OS == "WINNT"	)
      		return ROOT . '\\' . APP_DIR . '\\config\\config.ini.win.php';
		else
			return ROOT . '/' . APP_DIR . '/config/config.ini.nix.php';
	}
	
	public function saveConfig($array){
		$this->write_php_ini($array,$this->getConfigFilename());
	}
	
	function write_php_ini($array, $file)
	{
	    $res = array();
	    foreach($array as $key => $val)
	    {
	        if(is_array($val))
	        {
	            $res[] = "[$key]";
	            foreach($val as $skey => $sval) {
					$sval = str_replace("\"","\\\"",$sval);
					$res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
				}
	        }
	        else {
				$val = str_replace("\"","\\\"",$val);
				$res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
			}
	    }
	    $this->safefilerewrite($file, implode("\r\n", $res));
	}

	function safefilerewrite($fileName, $dataToSave)
	{   if ($fp = fopen($fileName, 'w'))
	    {
	        $startTime = microtime();
	        do
	        {  
			   $canWrite = flock($fp, LOCK_EX);
			    
	           // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
	           if(!$canWrite) usleep(round(rand(0, 100)*1000));
	        } while ((!$canWrite)and((microtime()-$startTime) < 1000));
	
	        //file was locked so now we can store information
	        if ($canWrite)
	        {            fwrite($fp, $dataToSave);
	            flock($fp, LOCK_UN);
	        }
	        fclose($fp);
	    }else{
			throw new Exception('Cant write to config ' . $fileName);
		}
	
	}	
}