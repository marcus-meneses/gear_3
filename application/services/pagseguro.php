<?php


define("PAC",1);
define("SEDEX",2);
define("OUTROS",3);



class Pagseguro extends Service
{

	public $stage='SANDBOX'; //PRODUCTION

	public $sandboxEmail = 'marcusmeneses.email@gmail.com';
	public $sandboxToken = '6926862CDA284681AEC736071803E249';
	public $sandboxCheckoutUrl = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';
	public $sandboxPaymentUrl =   'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=';
	public $sandboxNotificationsUrl = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/';
	public $sandboxRedirectUrl = '';

	public $productionEmail = 'marcusmeneses.email@gmail.com';
	public $productionToken = 'PRODUCTIONPRODUCTIONPRODUCTIONPRODUCTIONPRODUCTION';
	public $productionCheckoutUrl = 'https://ws.pagseguro.uol.com.br/v2/checkout';
	public $productionPaymentUrl = 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code=';
	public $productionNotificationsUrl = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/';
	public $productionRedirectUrl = '';


	public $email = '';
	public $token = '';
	public $checkoutUrl = '';
	public $paymentUrl = '';
	public $notificationsUrl = '';
	public $redirectUrl = '';


	public $returnUrl='http://mydomain.com/payment/validate';

	public $currency="BRL";


	public $sender=[];
	public $shipping=[];
	public $products=[];


    public function setSender($name, $areacode, $phone, $email) {

		$this->sender['senderName']=$name;
		$this->sender['senderAreaCode']=$areacode;
		$this->sender['senderPhone']=$phone;
		$this->sender['senderEmail']=$email;


    }


	public function setShipping($type, $cost, $street, $number, $complement, $district, $cep, $city, $state, $country) {

		//TODO create setter for each atomic parameter
		$this->shipping['shippingType'] = $type;
		$this->shipping['shippingCost'] = number_format( ($cost/100) ,2);

		$this->shipping['shippingAddressStreet'] = $street;
		$this->shipping['shippingAddressNumber'] = $number;
		$this->shipping['shippingAddressComplement'] = $complement;
		$this->shipping['shippingAddressDistrict'] = $district;
		$this->shipping['shippingAddressPostalCode'] = $cep;
		$this->shipping['shippingAddressCity'] = $city;
		$this->shipping['shippingAddressState'] = $state;
		$this->shipping['shippingAddressCountry'] = $country;

    }

	public function addProduct($id, $description, $amount, $qtty, $weight) {


    	$i=0;
    	$pos=1;

    	while ($i<count($this->products)+1) {
    	 if (isset($this->products['itemId'.$pos])) {
    	 	$pos++;
    	 	$i=0;
    	 }

    	 $i++;	
		}

		$this->products['itemId'.$pos] = $id;
		$this->products['itemDescription'.$pos] = $description;
		$this->products['itemAmount'.$pos] = number_format( ($amount/100) ,2);
		$this->products['itemQuantity'.$pos] = $qtty;
		$this->products['itemWeight'.$pos] = $weight;

    }


 // reference is the internal event code
    
    public function checkout($reference, $willsend=null) {


    	$this->requestsService->parameters($this->products);
    	$this->requestsService->setParameter('email',$this->email);
 		$this->requestsService->setParameter('token',$this->token);
 		$this->requestsService->setParameter('currency',$this->currency);
 		$this->requestsService->setParameter('reference',$reference);
		$this->requestsService->setParameter('redirectURL',$this->redirectUrl);
		 
 		
//buyer DATA -----------------------------------------------------------------

		$this->requestsService->setParameter('senderName',$this->sender['senderName']);
		$this->requestsService->setParameter('senderAreaCode',$this->sender['senderAreaCode']);
		$this->requestsService->setParameter('senderPhone',$this->sender['senderPhone']);
		$this->requestsService->setParameter('senderEmail',$this->sender['senderEmail']);

//-------------------------------------------------------------------------


 		if ($willsend==null) {
 			$this->requestsService->setParameter('shippingAddressRequired','false');
 		} else {


 			if ($willsend==false) {
 				$this->requestsService->setParameter('shippingAddressRequired','false');
 			} else {
 			
				$this->requestsService->setParameter('shippingAddressRequired','true');
				$this->requestsService->setParameter('shippingAddressStreet', $this->shipping['shippingAddressStreet']);
				$this->requestsService->setParameter('shippingAddressNumber', $this->shipping['shippingAddressNumber']);
				$this->requestsService->setParameter('shippingAddressComplement',$this->shipping['shippingAddressComplement']);
				$this->requestsService->setParameter('shippingAddressDistrict', $this->shipping['shippingAddressDistrict']);
				$this->requestsService->setParameter('shippingAddressPostalCode', $this->shipping['shippingAddressPostalCode']);
				$this->requestsService->setParameter('shippingAddressCity', $this->shipping['shippingAddressCity'] );
				$this->requestsService->setParameter('shippingAddressState',$this->shipping['shippingAddressState'] );
				$this->requestsService->setParameter('shippingAddressCountry', $this->shipping['shippingAddressCountry'] );


		    }

// TODO: CHECK 
 			// set shippingAddress parameters

 		}
 		
 
		$xml = simplexml_load_string($this->requestsService->exec(), "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);


    	return $array;
    }


	protected function afterConstruct() 
	{
		$this->loadService( 'requests' );


		 if ($this->stage=='PRODUCTION')
		 {

			 	$this->email = $this->productionEmail;
			 	$this->token = $this->productionToken;
			 	$this->checkoutUrl = $this->productionCheckoutUrl;
			 	$this->paymentUrl = $this->productionPaymentUrl;
			 	$this->notificationsUrl = $this->productionNotificationsUrl;
			 	$this->redirectUrl = $this->productionRedirectUrl;

		 } else if ($this->stage=='SANDBOX')
		 {

			 	$this->email = $this->sandboxEmail;
			 	$this->token = $this->sandboxToken;
			 	$this->checkoutUrl = $this->sandboxCheckoutUrl;
			 	$this->paymentUrl = $this->sandboxPaymentUrl;
			 	$this->notificationsUrl = $this->sandboxNotificationsUrl;
			 	$this->redirectUrl = $this->sandboxRedirectUrl;

		 } else {

		 }

		 $this->requestsService->url($this->checkoutUrl);
		 $this->requestsService->method('POST');
		 $this->requestsService->setHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');



	}
	
		protected function afterDestruct() 
	{
		
	}


}