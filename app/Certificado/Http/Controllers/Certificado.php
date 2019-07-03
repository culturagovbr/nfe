<?php

namespace App\Certificado\Http\Controllers;

use App\Certificado\Services\Certificado as CertificadoService;
use Illuminate\Http\Request;
use NFePHP\Common\Exception\ValidatorException;

class Certificado
{
    public function cadastrar(Request $request)
    {
        $file = $request['file'];

        if ($file->getClientOriginalExtension() != 'pfx') {
            return response()->json('Somente arquivo .pfx', 400);
        }

        try {
            $input = $request->all();

            $service = new CertificadoService();
            $service->cadastrar($input);

            return response()->json('Cadastrado com sucesso', 200);
        } catch (ValidatorException $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function listar()
    {
        try {
            $serviceCert = new CertificadoService();
            $service = $serviceCert->listarCertificado();

            return response()->json($service, 200);
        } catch (ValidatorException $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function excluir($id)
    {
        $service = new CertificadoService();
        $service->excluirCertificado($id);
    }

    public function atualizar(Request $request, $id)
    {
        try {
            $serviceCert = new CertificadoService();
            $service = $serviceCert->atualizarCertificado($request, $id);

            return response()->json('Atualizado com sucesso', 200);
        } catch (ValidatorException $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
