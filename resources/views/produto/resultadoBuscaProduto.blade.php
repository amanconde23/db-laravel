@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12 ">
                @if(isset($details))
                    <h1 class="titulo-pagina">Resultado da busca por {{ $query }} :</h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-info header-table">
                                <td>Nome</td>
                                <td>Categoria</td>
                                <td>Status</td>
                                <td>Ação</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->statusProduto }}</td>
                                <td class="align-middle btn-crud">
                                    <a class="btn btn-primary" href="{{ route('product-show-details', ['product' => $product->id]) }}">Ver Produto</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1 class="msg-busca-empty">{{ $message }}</h1>
                    <div class="space"></div>
                @endif
                <a class="btn btn-info btn-voltar" href="{{ url()->previous() }}">Voltar</a>
            </div>
        </div>
    </div>
@endsection
