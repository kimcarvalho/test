@extends('layout')

@section('title', 'Cadastrar')

@section('content')
<p>
  <h1>Cadastro de Clientes</h1>
</p>

<form method="POST" id="cliente" action="/cadastrar-cliente">  
  @csrf
  <div id="msg">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Parabéns!</strong> <br />Cliente cadastrado com sucesso!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>

  <!-- INPUT OF NOME -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Nome</span>
      </div>
      <input type="text" class="form-control" id="nome" name="nome" aria-describedby="telInfo" required>    
    </div>    
  </div>

  <!-- INPUT OF TEL -->
  <div class="form-group">    
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Tel</span>
      </div>
      <input type="text" class="form-control" id="tel" maxlength="11" name="tel[]" aria-describedby="telInfo" required>    
    </div> 
    
    <div id="div-tel"></div>
      
    <small id="telInfo" class="form-text text-muted">
      Adicionar outro telefone 
      <i class="fa fa-plus btn novo-tel" style="font-size:24px"></i>
    </small>       
  </div>   

  <!-- INPUT OF EMAIL -->
  <div class="form-group">    
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Email</span>
      </div>
      <input type="email" class="form-control" id="email" name="email[]" aria-describedby="emailInfo" required>    
    </div> 
    
    <div id="div-email"></div>
      
    <small id="emailInfo" class="form-text text-muted">
      Adicionar outro email 
      <i class="fa fa-plus btn novo-email" style="font-size:24px"></i>
    </small>       
  </div> 

  <button type="submit" class="btn btn-primary btn-sub">Cadastrar</button>
</form>

@endsection