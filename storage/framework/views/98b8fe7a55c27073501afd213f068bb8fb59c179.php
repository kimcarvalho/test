<?php $__env->startSection('title', 'Lista de Clientes'); ?>

<?php $__env->startSection('content'); ?>
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
                <?php if(!empty($clients)): ?>
                    <?php echo csrf_field(); ?>
                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="/clientes/<?php echo e($client->id); ?>" class="cli_name"><?php echo e($client->name); ?></a></td>
                            <td>
                                <div class="custom-control custom-checkbox">                                    
                                    <?php if($client->status == 1): ?>
                                        <label id="cli<?php echo e($client->id); ?>">Ativo: </label>
                                        <input type="checkbox" class="chk" value="<?php echo e($client->id); ?>" checked/>                                    
                                    <?php else: ?>
                                        <label id="cli<?php echo e($client->id); ?>">Inativo: </label>
                                        <input type="checkbox" class="chk" value="<?php echo e($client->id); ?>" />                                    
                                    <?php endif; ?>
                                </div>                                   
                            </td>
                        </tr>                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>                   
                </tr>
            </tfoot>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kimcarvalho/Documentos/Teste - O Gestor (DEV)/clientes/resources/views/clientes.blade.php ENDPATH**/ ?>