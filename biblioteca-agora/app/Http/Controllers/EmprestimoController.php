<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Locatario;
use Illuminate\Support\Facades\Validator;

class EmprestimoController extends Controller
{
    public function index()
    {
        if (auth()->user()->admin)
            $emprestimos = Emprestimo::paginate(10);
        else
            $emprestimos = Emprestimo::where('locatario_id', auth()->user()->locatario->id)->paginate(10);

        // Formatando as datas para "d/m/Y"
        $emprestimos->transform(function ($emprestimo) {
            $emprestimo->data_emprestimo = formatarData($emprestimo->data_emprestimo);
            $emprestimo->data_devolucao_esperada = formatarData($emprestimo->data_devolucao_esperada);
            $emprestimo->data_devolucao = $emprestimo->data_devolucao == null ? "Não devolvido" : formatarData($emprestimo->data_devolucao);
            return $emprestimo;
        });

        $livros = Livro::all();
        $locatarios = Locatario::all();

        return view('emprestimos.index', compact("emprestimos", "livros", "locatarios"));
    }

    public function pesquisar(Request $request)
    {
        if (auth()->user()->admin) {
            $emprestimos = Emprestimo::leftJoin('locatario', 'emprestimo.locatario_id', 'locatario.id')
                ->leftJoin('livro', 'emprestimo.livro_id', 'livro.id')
                ->where(function ($query) use ($request) {
                    $query->where('locatario.nome', 'like', '%' . $request->pesquisa . '%')
                        ->orWhere('livro.titulo', 'like', '%' . $request->pesquisa . '%');
                })
                ->orWhere('data_emprestimo', $request->pesquisa)
                ->orWhere('data_devolucao_esperada', $request->pesquisa)
                ->orWhere('data_devolucao', $request->pesquisa)
                ->paginate(10);
        } else {
            $emprestimos = Emprestimo::leftJoin('locatario', 'emprestimo.locatario_id', 'locatario.id')
                ->leftJoin('livro', 'emprestimo.livro_id', 'livro.id')
                ->where(function ($query) use ($request) {
                    $query->where('locatario.nome', 'like', '%' . $request->pesquisa . '%')
                        ->orWhere('livro.titulo', 'like', '%' . $request->pesquisa . '%');
                })
                ->orWhere('data_emprestimo', $request->pesquisa)
                ->orWhere('data_devolucao_esperada', $request->pesquisa)
                ->orWhere('data_devolucao', $request->pesquisa)
                ->paginate(10);
        }

        // Formatando as datas para "d/m/Y"
        $emprestimos->transform(function ($emprestimo) {
            $emprestimo->data_emprestimo = formatarData($emprestimo->data_emprestimo);
            $emprestimo->data_devolucao_esperada = formatarData($emprestimo->data_devolucao_esperada);
            $emprestimo->data_devolucao = $emprestimo->data_devolucao == null ? "Não devolvido" : formatarData($emprestimo->data_devolucao);
            return $emprestimo;
        });

        $livros = Livro::all();
        $locatarios = Locatario::all();

        return view('emprestimos.index', compact("emprestimos", "livros", "locatarios"));
    }

    public function criar()
    {
        $dados = request()->only(['locatario_id', 'livro_id', 'data_emprestimo', 'devolucao']);

        $regras = [
            'locatario_id' => 'required|exists:locatario,id',
            'livro_id' => 'required|exists:livro,id',
            'data_emprestimo' => 'required',
            'devolucao' => 'required|integer'
        ];

        $mensagens = [
            'locatario_id.required' => 'Você deve selecionar um locatário',
            'locatario_id.exists' => 'O locatário informado não existe',
            'livro_id.required' => 'Você deve selecionar um livro',
            'livro_id.exists' => 'O livro informado não existe',
            'data_emprestimo.required' => 'O campo data de empréstimo é obrigatório',
            'devolucao.required' => 'O campo Dias para Devolução é obrigatório',
            'devolucao.integer' => 'O campo Dias para Devolução deve ser um número inteiro'
        ];

        $validator = Validator::make($dados, $regras, $mensagens);

        if ($validator->fails()) {
            $mensagem = (object) [
                'tipo' => 'danger',
                'titulo' => 'Erro',
                'texto' => $validator->errors()->first(),
            ];
            dd($dados, $validator->errors());
            return redirect()->back()->with('message', $mensagem)->withInput();
        }

        $data_devolucao_esperada = date('Y-m-d', strtotime($dados['data_emprestimo'] . ' + ' . $dados['devolucao'] . ' days'));
        $data_emprestimo = date('Y-m-d', strtotime($dados['data_emprestimo']));

        $emprestimo = Emprestimo::create([
            'locatario_id' => $dados['locatario_id'],
            'livro_id' => $dados['livro_id'],
            'data_emprestimo' => $data_emprestimo,
            'data_devolucao_esperada' => $data_devolucao_esperada
        ]);

        $mensagem = (object) [
            'tipo' => 'success',
            'titulo' => 'Sucesso',
            'texto' => 'Empréstimo cadastrado com sucesso',
        ];

        return redirect()->back()->with('message', $mensagem);
    }

    public function emprestimo()
    {
        $emprestimo = Emprestimo::with('locatario', 'livro')->find(request()->id);

        //convertendo datas para o formato brasileiro
        $emprestimo->data_emprestimo = date('d/m/Y', strtotime($emprestimo->data_emprestimo));
        $emprestimo->data_devolucao_esperada = date('d/m/Y', strtotime($emprestimo->data_devolucao_esperada));
        $emprestimo->data_devolucao = $emprestimo->data_devolucao == null ? "Não devolvido" : date('d/m/Y', strtotime($emprestimo->data_devolucao));

        return view('emprestimos.detalhes', compact('emprestimo'));
    }

    public function devolver($id)
    {
        $emprestimo = Emprestimo::find($id);
        $emprestimo->data_devolucao = date('Y-m-d');
        $emprestimo->save();

        $mensagem = (object) [
            'tipo' => 'success',
            'titulo' => 'Sucesso',
            'texto' => 'Livro devolvido com sucesso',
        ];

        return redirect()->back()->with('message', $mensagem);
    }

    public function renovar($id)
    {
        $emprestimo = Emprestimo::find($id);
        if (
            $emprestimo->quantidade_renovacoes <= 3
            && $emprestimo->data_devolucao == null
            && ($emprestimo->data_devolucao_esperada > date('Y-m-d') || auth()->user()->admin)
        ) {
            $emprestimo->quantidade_renovacoes += 1;
            $emprestimo->data_devolucao_esperada = date('Y-m-d', strtotime($emprestimo->data_devolucao_esperada . ' + 7 days'));
            $emprestimo->save();

            $mensagem = (object) [
                'tipo' => 'success',
                'titulo' => 'Sucesso',
                'texto' => 'Livro renovado com sucesso',
            ];

            return redirect()->back()->with('message', $mensagem);
        } else {
            $mensagem = (object) [
                'tipo' => 'danger',
                'titulo' => 'Erro',
                'texto' => 'Este livro não pode mais ser renovado',
            ];

            return redirect()->back()->with('message', $mensagem);
        }
    }
}
