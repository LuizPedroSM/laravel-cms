@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1>Novo Usuário</h1>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <h4>Ocorreu um erro.</h4>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('users.store') }}" method="post" class="form-horizontal">
    @csrf
    <div class="form-group">
        <div class="row">
            <label for="name" class="col-sm-2 control-label">Nome Completo</label>
            <div class="col-sm-10">
            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="password" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="password_confirmation" class="col-sm-2 control-label">Confirmar Senha</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
        </div>
    </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="submit" value="Cadastrar" class="btn btn-success">
            </div>
        </div>
    </div>
</form>

@endsection
