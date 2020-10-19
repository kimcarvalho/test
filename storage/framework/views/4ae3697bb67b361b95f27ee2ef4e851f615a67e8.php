<?php $__env->startSection('title', 'Cadastrar'); ?>

<?php $__env->startSection('content'); ?>
<p>
  <h1>Dados do Cliente</h1>
</p>

  <!-- INPUT OF NOME -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Nome</span>
      </div>
      <?php if(!empty($cliente)): ?>
        <form method="POST" id="up_nome" action="/atualizar-cliente/<?php echo e($cliente->id); ?>">
          <?php echo csrf_field(); ?>
          <input type="text" class="form-control update border" id="nome" name="nome" maxlenght="60" value="<?php echo e($cliente->name); ?>" aria-describedby="telInfo" required>  
          <input type="hidden" id="update" name="update" value="cliente" />
        </form>
      <?php endif; ?>   
    </div>    
  </div>

  <!-- INPUT OF TEL -->  
  <?php if(!empty($tels)): ?>    
    <?php $__currentLoopData = $tels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Tel</span>
            </div>   
              <form method="POST" id="up_tel<?php echo e($tel->tel); ?>" action="/atualizar-cliente/<?php echo e($tel->id); ?>" >  
                <?php if($loop->first): ?> 
                  <input type="text" class="form-control update border" id="tel" name="tel" value="<?php echo e($tel->tel); ?>" maxlength="11" aria-describedby="telInfo" required>           
                <?php else: ?>
                  <div class="input-group-append">
                    <input type="text" class="form-control update border" id="tel" name="tel" value="<?php echo e($tel->tel); ?>" maxlength="11" aria-describedby="telInfo" required>           
                    <span class="input-group-text" id="basic-addon1" onclick="destroy('tel',<?php echo e($tel->id); ?>)"><i class="fas fa-trash-alt"></i></span>
                  </div>
                <?php endif; ?>  
                <?php echo csrf_field(); ?>              
                <input type="hidden" id="update" name="update" value="tel" />                
              </form>
          </div>           
      </div>   
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
  <?php endif; ?> 

  <!-- INPUT OF EMAIL -->
  <?php if(!empty($emails)): ?>    
    <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="form-group">    
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
          </div>
          <form method="POST" id="up_email<?php echo e($email->email); ?>" action="/atualizar-cliente/<?php echo e($email->id); ?>" >
            <?php if($loop->first): ?>
              <input type="email" class="form-control update border" id="email" name="email" maxlenght="50" value="<?php echo e($email->email); ?>" aria-describedby="emailInfo" required>    
            <?php else: ?>
              <div class="input-group-append">
                <input type="email" class="form-control update border" id="email" name="email" maxlenght="50" value="<?php echo e($email->email); ?>" aria-describedby="emailInfo" required>    
                <span class="input-group-text" id="basic-addon1" onclick="destroy('email',<?php echo e($email->id); ?>)"><i class="fas fa-trash-alt"></i></span>
              </div> 
            <?php endif; ?>  
            <?php echo csrf_field(); ?>          
            <input type="hidden" id="update" name="update" value="email" />
          </form>
        </div>   
      </div> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
  
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kimcarvalho/Documentos/Teste - O Gestor (DEV)/clientes/resources/views/cliente-edit.blade.php ENDPATH**/ ?>