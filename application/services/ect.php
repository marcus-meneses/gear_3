<?php

define("SEDEX_VAREJO",40010);
define("SEDEX_VAREJO_A_COBRAR",40045);
define("SEDEX_10_VAREJO",40215);
define("SEDEX_HOJE_VAREJO",40290);
define("PAC_VAREJO",41106);

define("CAIXA_PACOTE", 1);
define("ROLO_PRISMA", 2);
define("ENVELOPE",3);


class Ect extends Service
{


private $requestCalcPrecoPrazoUrl = "http://200.228.16.53/calculador/CalcPrecoPrazo.asmx/CalcPrecoPrazo";
//private $requestCalcPrecoPrazoUrl = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx/CalcPrecoPrazo";

//these seem obsolete, as they are given by the server after unsuccessful requests
/*
private $errCodes = [   "0"=>"Processamento com sucesso.",
                        "-1"=>"Código de serviço inválido.",
                        "-2"=>"CEP de origem inválido.",
                        "-3"=>"CEP de destino inválido.",
                        "-4"=>"Peso excedido.",
                        "-5"=>"O Valor Declarado não deve exceder R$ 10.000,00",
                        "-6"=>"Serviço indisponível para o trecho informado.",
                        "-7"=>"O Valor Declarado é obrigatório para este serviço.",
                        "-8"=>"Este serviço não aceita Mão Própria.",
                        "-9"=>"Este serviço não aceita Aviso de Recebimento.",
                        "-10"=>"Precificação indisponível para o trecho informado.",
                        "-11"=>"Para definição do preço deverão ser informados, também, o comprimento, a largura e altura do objeto em centímetros (cm).",
                        "-12"=>"Comprimento inválido.",
                        "-13"=>"Largura inválida.",
                        "-14"=>"Altura inválida.",
                        "-15"=>"O comprimento não pode ser maior que 105 cm.",
                        "-16"=>"A largura não pode ser maior que 105 cm.",
                        "-17"=>"A altura não pode ser maior que 105 cm.",
                        "-18"=>"A altura não pode ser inferior a 2 cm.",
                        "-20"=>"A largura não pode ser inferior a 11 cm.",
                        "-22"=>"O comprimento não pode ser inferior a 16 cm.",
                        "-23"=>"A soma resultante do comprimento + largura + altura não deve superar a 200 cm.",
                        "-24"=>"Comprimento inválido.",
                        "-25"=>"Diâmetro inválido.",
                        "-26"=>"Informe o comprimento.",
                        "-27"=>"Informe o diâmetro.",
                        "-28"=>"O comprimento não pode ser maior que 105 cm.",
                        "-29"=>"O diâmetro não pode ser maior que 91 cm.",
                        "-30"=>"O comprimento não pode ser inferior a 18 cm.",
                        "-31"=>"O diâmetro não pode ser inferior a 5 cm.",
                        "-32"=>"A soma resultante do comprimento + o dobro do diâmetro não deve superar os 200 cm.",
                        "-33"=>"Sistema temporariamente fora do ar. Favor tentar mais tarde.",
                        "-34"=>"Código Administrativo ou Senha inválidos.",
                        "-35"=>"Senha incorreta.",
                        "-36"=>"Cliente não possui contrato vigente com os Correios.",
                        "-37"=>"Cliente não possui serviço ativo em seu contrato.",
                        "-38"=>"Serviço indisponível para este código administrativo.",
                        "-39"=>"Peso excedido para o formato envelope.",
                        "-40"=>"Para definicao do preco deverao ser informados, tambem, o comprimento e a largura e altura do objeto em centimetros (cm).",
                        "-41"=>"O comprimento nao pode ser maior que 60 cm.",
                        "-42"=>"O comprimento nao pode ser inferior a 16 cm.",
                        "-43"=>"A soma resultante do comprimento + largura nao deve superar a 120 cm.",
                        "-44"=>"A largura nao pode ser inferior a 11 cm.",
                        "-45"=>"A largura nao pode ser maior que 60 cm.",
                        "-888"=>"Erro ao calcular a tarifa.",
                        "006"=>"Localidade de origem não abrange o serviço informado.",
                        "007"=>"Localidade de destino não abrange o serviço informado.",
                        "008"=>"Serviço indisponível para o trecho informado.",
                        "009"=>"CEP inicial pertencente a Área de Risco.",
                        "010"=>"Área com entrega temporariamente sujeita a prazo diferenciado.",
                        "011"=>"CEP inicial e final pertencentes a Área de Risco.",
                        "7"=>"Serviço indisponível, tente mais tarde.",
                        "99"=>"Outros erros diversos do .Net."  ];
*/

private $indata=[];
 


public function set($key, $data)
{
$this->indata[$key] = $data;
}

    public function calcularPrecoPrazo()
    {
        $this->requestsService->url($this->requestCalcPrecoPrazoUrl);
        $this->requestsService->method('GET');
        //$this->requestsService->setHeader('Content-Type','application/x-www-form-urlencoded');
        $this->requestsService->setHeader('Host','ws.correios.com.br');


//$this->requestsService->setHeader('Accept','text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8');
//$this->requestsService->setHeader('Accept-Encoding','gzip, deflate');
//$this->requestsService->setHeader('Accept-Language','pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4');
//$this->requestsService->setHeader('Cache-Control','max-age=0');
//$this->requestsService->setHeader('Connection','keep-alive');
//$this->requestsService->setHeader('Host','ws.correios.com.br');
//$this->requestsService->setHeader('Upgrade-Insecure-Requests','1');
//$this->requestsService->setHeader('User-Agent','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36');



        $this->requestsService->setParameter( 'nCdEmpresa',         $this->indata['cadastroEmpresa']);
        $this->requestsService->setParameter( 'sDsSenha',           $this->indata['cadastroSenha']);
        $this->requestsService->setParameter( 'nCdServico',         $this->indata['servico']);
        $this->requestsService->setParameter( 'sCepOrigem',         $this->indata['CepOrigem']);
        $this->requestsService->setParameter( 'sCepDestino',        $this->indata['CepDestino']);
        $this->requestsService->setParameter( 'nVlPeso',            $this->indata['peso']);
        $this->requestsService->setParameter( 'nCdFormato',         $this->indata['formato']);
        $this->requestsService->setParameter( 'nVlComprimento',     $this->indata['comprimento']);
        $this->requestsService->setParameter( 'nVlAltura',          $this->indata['altura']);
        $this->requestsService->setParameter( 'nVlLargura',         $this->indata['largura']);
        $this->requestsService->setParameter( 'nVlDiametro',        $this->indata['diametro']);
        $this->requestsService->setParameter( 'sCdMaoPropria',      $this->indata['maoPropria']);
        $this->requestsService->setParameter( 'sCdAvisoRecebimento',$this->indata['avisoDeRecebimento']);
        $this->requestsService->setParameter( 'nVlValorDeclarado',  $this->indata['valorDeclarado']);
    

        $xml = simplexml_load_string($this->requestsService->exec(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        // $xmldata = new SimpleXMLElement($this->requestsService->exec());
        $returnArray = [];

        if (isset($array['Servicos'])) 
        {

            if ($array['Servicos']['cServico']['Erro']!=0)
            {
            
            $returnArray['erro'] = $array['Servicos']['cServico']['Erro'];
            $returnArray['mensagem'] = $array['Servicos']['cServico']['MsgErro'];
            $returnArray['valor'] = 0;
            $returnArray['prazo'] = 0;
            $returnArray['domiciliar'] = false;
            $returnArray['sabado'] = false;

            } else {

            $reduce = $array['Servicos']['cServico'];
            $reduce['Valor'] = floatval(str_replace(',', '.', str_replace('.', '', $reduce['Valor'])));
            $reduce['ValorMaoPropria'] = floatval(str_replace(',', '.', str_replace('.', '', $reduce['ValorMaoPropria'])));
            $reduce['ValorAvisoRecebimento'] = floatval(str_replace(',', '.', str_replace('.', '', $reduce['ValorAvisoRecebiment'])));
            $reduce['ValorValorDeclarado'] = floatval(str_replace(',', '.', str_replace('.', '', $reduce['ValorValorDeclarado'])));
            
            $reduce['Valor'] *= 100;
            $reduce['ValorMaoPropria'] *= 100;
            $reduce['ValorAvisoRecebimento'] *= 100;
            $reduce['ValorValorDeclarado'] *= 100;

            if($reduce['EntregaDomiciliar']=='S') 
            {
               $reduce['EntregaDomiciliar']=true;
            } else {
               $reduce['EntregaDomiciliar']=false;
            }

            if($reduce['EntregaSabado']=='S') 
            {
               $reduce['EntregaSabado']=true;
            } else {
               $reduce['EntregaSabado']=false;
            }

            $returnArray['erro'] = 0;
            $returnArray['mensagem'] = 'Sucesso';
            $returnArray['valor'] =  $reduce['Valor']+$reduce['ValorMaoPropria']+$reduce['ValorAvisoRecebimento']+$reduce['ValorValorDeclarado'];
            $returnArray['prazo'] =  $reduce['PrazoEntrega'];
            $returnArray['domiciliar'] = $reduce['EntregaDomiciliar'];
            $returnArray['sabado'] = $reduce['EntregaSabado'];

            }

        } else {

            $returnArray['erro'] = '666';
            $returnArray['mensagem'] = 'Serviço indisponível por razões desconhecidas.';
            $returnArray['valor'] = 0;
            $returnArray['prazo'] = 0;
            $returnArray['domiciliar'] = false;
            $returnArray['sabado'] = false;

        }

        return $returnArray;
    }


    public function calcular()
    {      
         return $this->calcularPrecoPrazo();
    }


    public function calcularPreco()
    {
        //service function not yet implemented;
    }


    public function calcularPrazo ()
    {
        //service function not yet implemented;
    }

	
	protected function afterConstruct() 
	{
		$this->loadService( 'requests' );

       $this->indata['cadastroEmpresa']='';
        $this->indata['cadastroSenha']='';

        $this->indata['servico'] = PAC_VAREJO;

        $this->indata['CepOrigem'] = '38610000';
        $this->indata['CepDestino'] = '38610000';

        $this->indata['peso'] = 1;
        $this->indata['formato'] = CAIXA_PACOTE;
        $this->indata['comprimento'] = 16; //comprimento
        $this->indata['largura'] = 11; //largura
        $this->indata['altura'] = 10; //altura
        $this->indata['diametro'] = 10; //diâmetro (para pacotes ROLO_PRISMA)

        $this->indata['maoPropria'] = 'N';
        $this->indata['avisoDeRecebimento'] = 'N';
        $this->indata['valorDeclarado'] = 0;

	}
 
 	protected function afterDestruct()
	{
	 
	}

}