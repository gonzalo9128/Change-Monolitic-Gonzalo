<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <h2 class="mb-4">Peticiones que has firmado</h2>

        <?php if($petitions->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $petitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $petition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            
                            <?php if($petition->files->count() > 0): ?>
                                <img src="<?php echo e(asset('petitions/' . $petition->files->first()->name)); ?>"
                                     class="card-img-top"
                                     alt="<?php echo e($petition->title); ?>"
                                     style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">Sin imagen</span>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($petition->title); ?></h5>
                                <p class="card-text text-muted small">
                                    <?php echo e(Str::limit($petition->description, 100)); ?>

                                </p>

                                
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                </div>
                                <small class="text-success fw-bold">
                                    <i class="bi bi-check-circle"></i> Firmado
                                </small>
                            </div>

                            <div class="card-footer bg-white border-top-0">
                                <a href="<?php echo e(route('petitions.show', $petition->id)); ?>" class="btn btn-outline-danger w-100">Ver Petición</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <h4>Aún no has firmado ninguna petición.</h4>
                <p>¡Explora las peticiones activas y apoya las causas que te importan!</p>
                <a href="<?php echo e(route('petitions.index')); ?>" class="btn btn-primary mt-2">Ver Peticiones</a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/petitions/firmadas.blade.php ENDPATH**/ ?>