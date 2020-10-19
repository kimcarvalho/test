@extends('layout')

@section('title', 'Cadastrar')

@section('content')
<p>
  <h1>Dados do Cliente</h1>
</p>

  <!-- INPUT OF NOME -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Nome</span>
      </div>
      @if(!empty($cliente))
        <form method="POST" id="up_nome" action="/atualizar-cliente/{{$cliente->id}}">
          @csrf
          <input type="text" class="form-control update border" id="nome" name="nome" maxlenght="60" value="{{$cliente->name}}" aria-describedby="telInfo" required>  
          <input type="hidden" id="update" name="update" value="cliente" />
        </form>
      @endif   
    </div>    
  </div>

  <!-- INPUT OF TEL -->  
  @if(!empty($tels))    
    @foreach($tels as $tel)
      <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Tel</span>
            </div>   
              <form method="POST" id="up_tel{{$tel->tel}}" action="/atualizar-cliente/{{$tel->id}}" >  
                @if($loop->first) 
                  <input type="text" class="form-control update border" id="tel" name="tel" value="{{$tel->tel}}" maxlength="11" aria-describedby="telInfo" required>           
                @else
                  <div class="input-group-append">
                    <input type="text" class="form-control update border" id="tel" name="tel" value="{{$tel->tel}}" maxlength="11" aria-describedby="telInfo" required>           
                    <span class="input-group-text" id="basic-addon1" onclick="destroy('tel',{{$tel->id}})"><i class="fas fa-trash-alt"></i></span>
                  </div>
                @endif  
                @csrf              
                <input type="hidden" id="update" name="update" value="tel" />                
              </form>
          </div>           
      </div>   
    @endforeach 
  @endif 

  <!-- INPUT OF EMAIL -->
  @if(!empty($emails))    
    @foreach($emails as $email)
      <div class="form-group">    
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
          </div>
          <form method="POST" id="up_email{{$email->email}}" action="/atualizar-cliente/{{$email->id}}" >
            
          <!-- IF THE FIRST (IT HAS NO BUTTON OF DELETE (TRASH)-->
            @if($loop->first)
              <input type="email" class="form-control update border" id="email" name="email" maxlenght="50" value="{{$email->email}}" aria-describedby="emailInfo" required>    
            @else
              <div class="input-group-append">
                <input type="email" class="form-control update border" id="email" name="email" maxlenght="50" value="{{$email->email}}" aria-describedby="emailInfo" required>    
                <span class="input-group-text" id="basic-addon1" onclick="destroy('email',{{$email->id}})"><i class="fas fa-trash-alt"></i></span>
              </div> 
            @endif  
            
            @csrf          
            <input type="hidden" id="update" name="update" value="email" />
          </form>
        </div>   
      </div> 
    @endforeach
  @endif
  
</form>

@endsection