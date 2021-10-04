<?php
  namespace STATENAME\Common;

  class GeneralFunctions
  {
    function getServerTime()
    {
      // // Process and send Server Time
      // $dt = new \DateTime("now", new \DateTimeZone('Asia/Kolkata'));
      // $dt->add(new \DateInterval('PT3H')); // Change server time for testing
      // return $dt->format('Y-m-d H:i:sP');
      
      $dt = new \DateTime("now", new \DateTimeZone('Asia/Kolkata'));
      return $dt->format('Y-m-d H:i:sP');
    }

    /**
     * To get local testing domain names
     * 
     * @return string[] domain names eg. http://dfw.cmwssb.in
     */
    function getAllowedDomains()
    {
      return ['http://localhost:4200','http://localhost:8000','http://localhost:8080'];
    }

    /**
     * add COR Headers after testing for ORIGIN (REQUEST)
     * 
     * @return bool true on REQUEST METHOD is OPTIONS else false
    */
    function addCORHeaders()
    {
      $origin = $this->getRequestOrigin();
      $allowed_domains = $this->getAllowedDomains();
      if (in_array(strtolower($origin), $allowed_domains, true)) {
        header('Access-Control-Allow-Origin: *', true);
        header('Access-Control-Allow-Headers: Content-Type, authorization', true);
      }
    
      return ($_SERVER['REQUEST_METHOD'] == 'OPTIONS');
    }

    /**
     * add General Headers
     */
    function addGeneralHeaders()
    {
      header('Content-Type: application/json');
      header('X-Content-Type-Options: nosniff');

      header('Access-Control-Expose-Headers: Content-Length, Content-Type, X-TOKEN', true);
    }

    function getRequestOrigin()
    {
      $origin = '';
      if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        $origin = $_SERVER['HTTP_ORIGIN'];
      }
      else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $origin = $_SERVER['HTTP_REFERER'];
      } else {
        $origin = $_SERVER['REMOTE_ADDR'];
      }
      return $origin;
    }

    function getDomainName()
    {
      // $url = (isset($_SERVER['HTTPS']) ? "https":"http")."://".$_SERVER['SERVER_NAME'].htmlentities($_SERVER['PHP_SELF']);
      // $url = explode("/svr", $url);
      // return $url[0];
      $domain_name = (isset($_SERVER['HTTPS']) ? "https":"http")."://".$_SERVER['SERVER_NAME'];
      return $domain_name;
    }

    function getIPAddress()
    {
      foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
          foreach (explode(',', $_SERVER[$key]) as $ip) {
            $ip = trim($ip); // just to be safe

            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
              return $ip;
            }
          }
        }
      }
    }

    function generateSecretKey($strength = 16)
    {
      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      if (strlen($permitted_chars) < $strength)
      {
        throw new \Exception('Strength should not be greater than '.strlen($permitted_chars));
      }
      // $charactersLength = strlen($characters);
      // $randomString = '';
      // for ($i = 0; $i < $charactersLength; $i++) {
      //   $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
      // }
      $randomString = substr(str_shuffle($permitted_chars), 0, $strength);
      return $randomString;
    }

    function log($message)
    {
      date_default_timezone_set("Asia/Calcutta");
      $logFileName = __DIR__."/../../../logs/ge-".date('ymd').".log";
      $txt = '['.date("Y-m-d h:i:sa").'] ['.$message.'] '.PHP_EOL;
      file_put_contents($logFileName, $txt, FILE_APPEND);
    }
  }
?>
