@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 sidebar-dashboard">
                <nav class="nav flex-column ">
                    <a class="nav-link btn-sidebar-dashboard" href="{{ route ('user', ['user' => Auth::user()->id]) }}"><i class="fas fa-user"></i> Meu Perfil</a>
                    <a class="nav-link btn-sidebar-dashboard" href="{{ route('products') }}"><i class="fas fa-box-open"></i> Meus Produtos</a>
                    <a class="nav-link btn-sidebar-dashboard" href="{{ route('product-new') }}"><i class="fas fa-plus-circle"></i> Cadastrar Produto</a>
                    <a class="nav-link btn-sidebar-dashboard" href="{{ route('all-products') }}"><i class="fas fa-search"></i> Buscar Produto</a>
                    <a class="nav-link btn-sidebar-dashboard" href="{{ route('rate-user') }}"><i class="fas fa-star"></i> Avaliar Usuário</a>
                </nav>
            </div>

            <div class="col-md-8 col-sm-8 content-user-pannel">
                <h1 class="titulo-dashboard">Portal de Economia Colaborativa</h1>
                <img class="bg-img-dashboard" src="{{ asset('images/bg_image.jpg') }}" alt="Pessoas montando um quebra-cabeça">
            </div>
        </div>
    </div>
@endsection
