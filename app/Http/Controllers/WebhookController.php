<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function processEduzzWebhook(Request $request)
    {   
        //requisição POST
        $data = $request->all();

        if ($data['api_key'] == 'APIKEY') {
            switch ($data['trans_status']) {
                case '3':
                    $this->liberaAcesso();
                    break;
                case '6':
                case '7':
                    //$this->removeAcesso();
                    break;
                // Outros casos...
                default:
                    return "STATUS DESCONHECIDO";
            }
        } else {
            return "ACESSO INVÁLIDO";
        }
    }

    private function liberaAcesso()
    {
        //Essa função ira buscar inserir um novo pagamento na tabela "pagamentos" para contabilizar a quitação ou não dos planos
        return null;
    }

}
