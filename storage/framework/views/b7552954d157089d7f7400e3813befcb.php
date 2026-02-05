<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Administración de Peticiones</h2>

        <a href="<?php echo e(route('adminpeticiones.create')); ?>" class="btn btn-primary mb-3">Añadir Petición</a>

        <table class="table table-striped align-middle"> <thead>
            <tr>
                <th>Id</th>
                <th>Imagen</th> <th>Titulo</th>
                <th>Descripcion</th>
                <th>Firmantes</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $peticiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peticion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($peticion->id); ?></td>

                    
                    <td>
                        <?php if($peticion->files->count() > 0): ?>
                            
                            <img src="<?php echo e(asset('petitions/' . $peticion->files->first()->name)); ?>"
                                 alt="Imagen"
                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                        <?php else: ?>
                            <span class="text-muted small">Sin foto</span>
                        <?php endif; ?>
                    </td>

                    <td><?php echo e($peticion->title); ?></td>
                    <td><?php echo e(Str::limit($peticion->description, 50)); ?></td> 
                    <td><?php echo e($peticion->signers); ?></td>

                    <td>
                        
                        <?php echo e($peticion->status ?? $peticion->state); ?>

                    </td>

                    <td>
                        <a href="<?php echo e(route('adminpeticiones.show', $peticion->id)); ?>" class="btn btn-info btn-sm">Ver</a>

                        <a href="<?php echo e(route('adminpeticiones.edit', $peticion->id)); ?>" class="btn btn-warning btn-sm">Editar</a>

                        <form action="<?php echo e(route('adminpeticiones.delete', $peticion->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Borrar</button>
                        </form>

                        
                        
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/admin/peticiones/index.blade.php ENDPATH**/ ?>