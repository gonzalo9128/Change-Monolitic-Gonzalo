<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Detalles de la Petición #<?php echo e($petition->id); ?></h3>
                <a href="<?php echo e(route('adminpeticiones.index')); ?>" class="btn btn-secondary">Volver</a>
            </div>

            <div class="card-body">
                
                <h2 class="card-title text-primary"><?php echo e($petition->title); ?></h2>

                <p class="card-text mt-3">
                    <strong>Descripción completa:</strong><br>
                    <?php echo e($petition->description); ?>

                </p>

                
                <div class="card mb-4 border-0">
                    <div class="card-body text-center">
                        <?php if($petition->files->count() > 0): ?>
                            <img src="<?php echo e(asset('petitions/' . $petition->files->first()->name)); ?>"
                                 alt="Imagen de la petición"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; object-fit: cover;">
                        <?php else: ?>
                            <div class="alert alert-secondary d-inline-block">
                                Esta petición no tiene imágenes adjuntas.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>

                
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Total Firmas:</strong>
                            
                            <span class="fs-4 d-block"><?php echo e($petition->firmantes->count()); ?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Estado:</strong>
                            
                            <span class="badge bg-<?php echo e($petition->status == 'accepted' ? 'success' : ($petition->status == 'rejected' ? 'danger' : 'warning')); ?> fs-6 d-block mt-1">
                                <?php echo e(ucfirst($petition->status ?? $petition->state)); ?>

                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Autor ID:</strong>
                            <span class="d-block"><?php echo e($petition->user_id); ?></span>
                        </div>
                    </div>
                </div>

                <hr>

                
                <h4 class="mt-4"> Usuarios que han firmado</h4>

                <?php if($petition->firmantes->count() > 0): ?>
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-dark">
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $petition->firmantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($usuario->id); ?></td>
                                <td><?php echo e($usuario->name); ?></td>
                                <td><?php echo e($usuario->email); ?></td>
                                <td><?php echo e($usuario->created_at->format('d/m/Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="alert alert-warning mt-3">Aún nadie ha firmado esta petición.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/admin/peticiones/show.blade.php ENDPATH**/ ?>