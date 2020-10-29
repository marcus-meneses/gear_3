<?php


class Cielo extends Service
{

	public $stage='SANDBOX'; //PRODUCTION


	public $sandboxId = '9051d23b-59ff-4863-b06e-fc0e9d6e15f7';
	public $sandboxKey = 'cwsEt29UXKeZkeKk0c7wvFd2VfUL1fsRNcg6Hd6S';
	public $sandboxRequestUrl = 'https://apisandbox.cieloecommerce.cielo.com.br';
	public $sandboxQueryUrl  =   'https://apiquerysandbox.cieloecommerce.cielo.com.br';
 
	public $productionId = '9051d23b-59ff-4863-b06e-fc0e9d6e15f7';
	public $productionKey = 'cwsEt29UXKeZkeKk0c7wvFd2VfUL1fsRNcg6Hd6S';
	public $productionRequestUrl = 'https://api.cieloecommerce.cielo.com.br/';
	public $productionQueryUrl  =   'https://apiquery.cieloecommerce.cielo.com.br/';


	public $id = '';
	public $key = '';
	public $requestUrl = '';
	public $queryUrl = '';
 
	public $order;


    public function setCustomer($name, $identity, $phone, $email) {


		$this->order->Customer->Identity = $identity;
		$this->order->Customer->FullName = $name;
		$this->order->Customer->Email = $email;
		$this->order->Customer->Phone = $phone;


    }

/*
$order = new stdClass();
$order->OrderNumber = '1234';
$order->SoftDescriptor = 'Nome que aparecerá na fatura';
$order->Cart = new stdClass();
$order->Cart->Discount = new stdClass();
$order->Cart->Discount->Type = 'Percent';
$order->Cart->Discount->Value = 10;
$order->Cart->Items = array();
$order->Cart->Items[0] = new stdClass();
$order->Cart->Items[0]->Name = 'Nome do produto';
$order->Cart->Items[0]->Description = 'Descrição do produto';
$order->Cart->Items[0]->UnitPrice = 100;
$order->Cart->Items[0]->Quantity = 2;
$order->Cart->Items[0]->Type = 'Asset';
$order->Cart->Items[0]->Sku = 'Sku do item no carrinho';
$order->Cart->Items[0]->Weight = 200;
$order->Shipping = new stdClass();
$order->Shipping->Type = 'Correios';
$order->Shipping->SourceZipCode = '14400000';
$order->Shipping->TargetZipCode = '11000000';
$order->Shipping->Address = new stdClass();
$order->Shipping->Address->Street = 'Endereço de entrega';
$order->Shipping->Address->Number = '123';
$order->Shipping->Address->Complement = '';
$order->Shipping->Address->District = 'Bairro da entrega';
$order->Shipping->Address->City = 'Cidade da entrega';
$order->Shipping->Address->State = 'SP';
$order->Shipping->Services = array();
$order->Shipping->Services[0] = new stdClass();
$order->Shipping->Services[0]->Name = 'Serviço de frete';
$order->Shipping->Services[0]->Price = 123;
$order->Shipping->Services[0]->DeadLine = 15;
$order->Payment = new stdClass();
$order->Payment->BoletoDiscount = 0;
$order->Payment->DebitDiscount = 10;
$order->Customer = new stdClass();
$order->Customer->Identity = 11111111111;
$order->Customer->FullName = 'Fulano Comprador da Silva';
$order->Customer->Email = 'fulano@email.com';
$order->Customer->Phone = '11999999999';
$order->Options = new stdClass();
$order->Options->AntifraudEnabled = false;
*/
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