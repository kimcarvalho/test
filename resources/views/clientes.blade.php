@extends('layout')

@section('title', 'Lista de Clientes')

@section('content')
    <p>
        <div id="msg-status">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Atualizado!</strong> <br />Status do Cliente, alterado com sucesso!                 
            </div>
        </div>
    </p>
    <p>
        <h1>Lista de Clientes</h1>        
    </p>
    <p>        
        <table id="clients" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>                   
                </tr>
            </thead>
            <tbody>
                @if(!empty($clients))
                    @csrf
                    @foreach($clients as $client)
                        <tr>
                            <td><a href="/clientes/{{$client->id}}" class="cli_name">{{ $client->name}}</a></td>
                            <td>
                                <div class="custom-control custom-checkbox">                                    
                                    @if($client->status == 1)
                                        <label id="cli{{$client->id}}">Ativo: </label>
                                        <input type="checkbox" class="chk" value="{{$client->id}}" checked/>                                    
                                    @else
                                        <label id="cli{{$client->id}}">Inativo: </label>
                                        <input type="checkbox" class="chk" value="{{$client->id}}" />                                    
                                    @endif
                                </div>                                   
                            </td>
                        </tr>                        
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>                   
                </tr>
            </tfoot>
    </p>
@endsection
