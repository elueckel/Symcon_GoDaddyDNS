<?

if (!defined('vtBoolean')) {
    define('vtBoolean', 0);
    define('vtInteger', 1);
    define('vtFloat', 2);
    define('vtString', 3);
    define('vtArray', 8);
    define('vtObject', 9);
}


	class Symcon_GoDaddyDNS extends IPSModule
	
	{
		
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			
			//Properties
			$this->RegisterPropertyInteger("SourceID", 0);
			$this->RegisterPropertyBoolean("DNSUpdate", 0);
			$this->RegisterPropertyString("RootDomain","");
			$this->RegisterPropertyString("ARecord","");
			$this->RegisterPropertyString("APIKey", "");
			$this->RegisterPropertyString("Secret", "");
			$this->RegisterPropertyBoolean("PublicIPVariable",0);
			$this->RegisterPropertyInteger("Timer", 0);
			$this->RegisterPropertyBoolean("Debug", 0);
			
												
			//Component sets timer, but default is OFF
			$this->RegisterTimer("UpdateTimer",0,"GDDNS_DNSUpdate(\$_IPS['TARGET']);");
					
	
		}
	
	public function ApplyChanges()
	{
			
		//Never delete this line!
		parent::ApplyChanges();
		
								
		//Timers Update - if greater than 0 = On
		
		$TimerMS = $this->ReadPropertyInteger("Timer") * 1000;
		$this->SetTimerInterval("UpdateTimer",$TimerMS);
					
		$vpos = 15;			
			
		$this->MaintainVariable('PublicIP', $this->Translate('PublicIP'), vtString, "", $vpos++, $this->ReadPropertyBoolean("PublicIPVariable") == 1);
				
			
	}
	
		
	public function DNSUpdate()
	{
		
			$RootDomain = $this->ReadPropertyString("RootDomain");
			$ARecord = $this->ReadPropertyString("ARecord");
			$Key = $this->ReadPropertyString("APIKey");
			$Secret = $this->ReadPropertyString("Secret");	
			$DNSUpdate = $this->ReadPropertyBoolean("DNSUpdate");
			$PublicIPVariable = $this->ReadPropertyBoolean("PublicIPVariable");
			$Debug = $this->ReadPropertyBoolean("Debug");	
			
			
//Get current public IP

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 'http://ipinfo.io/json');
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			$json = curl_exec($ch);
			curl_close($ch);

			$data = json_decode($json);

			$public_ip = $data->ip;
			
			If ($PublicIPVariable == 1)			
				{
				$sourceID = $this->ReadPropertyInteger("SourceID");	
				SetValue($this->GetIDForIdent("PublicIP"), $public_ip);	
				}
			
			
			
			If ($Debug == 1)
				{
				$this->SendDebug('Externe IP: ', $public_ip,0);
				}
			

//Return current setting 
     
			If ($DNSUpdate == 1)
			{
	 
				$url = 'https://api.godaddy.com/v1/domains/'.$RootDomain.'/records/A/'.$ARecord;
				
				
				// set your key and secret
				$header = array(
					'Authorization: sso-key '.$Key.':'.$Secret
				);
			 
				//open connection
				$ch = curl_init();
				$timeout=60;
			 
				//set the url and other options for curl
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);  
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Values: GET, POST, PUT, DELETE, PATCH, UPDATE 
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			 
				$result = curl_exec($ch);
			 
				curl_close($ch);
			 
				$dn = json_decode($result, true);
			 
				$dnsip = $dn[0]['data'];
				
				If ($Debug == 1)
					{
					$this->SendDebug('IP in DNS: ', $dnsip,0);
				}
				
			}

// Update

			If ($DNSUpdate == 1)
			{
				
				If ($dnsip != $public_ip)
				{

					$input_json = array("data" => $public_ip, "ttl"=> 3600);
					$data_string = json_encode($input_json);
					$data_string = "[ ".$data_string." ]";
									
					$url = 'https://api.godaddy.com/v1/domains/'.$RootDomain.'/records/A/'.$ARecord;
					
					// set your key and secret
					$header = array(
						'Authorization: sso-key '.$Key.':'.$Secret,
						'Content-Type: application/json',
						'Accept: application/json'  		
					);
					
					//open connection
					$ch = curl_init();
					$timeout=60;
				 
					//set the url and other options for curl
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);  
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
					curl_setopt($ch, CURLOPT_POST, true);
					$result = curl_exec($ch);
					curl_close($ch);
					$dn = json_decode($result, true);
				 
					
						If ($Debug == 1)
						{
						$this->SendDebug('DNS Update', 'Eintrag im DNS aktualisiert', 0);
						}
							
				}

				ElseIf (($dnsip == $public_ip) AND ($Debug == 1))
				{
					
					$this->SendDebug('DNS Update', 'Eintrag im DNS nicht aktualisiert', 0);
									
				}
				
				
							
			}

			ElseIf (($DNSUpdate == 0) AND ($Debug == 1))
			{
				
				$this->SendDebug('DNS Update', 'Nicht aktiv', 0);
				
			}	
			
		}
		
	}
?>
