<?php

namespace app\Certificado\Services;

use \App\Nfe\Models\Cert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Certificado
{
    public function cadastrar($request)
    {
        $file = $request['file'];

        $cadastrar = new Cert();
        $cadastrar->razaosocial = $request['razaosocial'];
        $cadastrar->cnpj = $request['cnpj'];
        $cadastrar->tpAmb = $request['tpAmb'];
        $cadastrar->pass = $request['pass'];
        $cadastrar->path = $file->getClientOriginalName();
        $cadastrar->save();

        Storage::disk('local')
            ->put($file->getClientOriginalName(), File::get($file));
    }

    public function listarCertificado()
    {
        $certificado = Cert::all();

        return $certificado;
    }

    public function excluirCertificado($id)
    {
        $excluirCertificado = Cert::find($id);
        $excluirCertificado->delete();
    }

    public function atualizarCertificado($request, $id)
    {
        $atualizar = Cert::find($id)
            ->update($request->all());

        return $atualizar;
    }
}
