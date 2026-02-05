<?php $__env->startSection('content'); ?>
    <section class="container mt-5 mb-5">

        <h2 class="fw-bold mb-4 border-bottom pb-2"><?php echo e($title ?? 'Listado de Peticiones'); ?></h2>

        <?php if($petitions->isEmpty()): ?>
            <div class="alert alert-info text-center">
                <h4>Vaya, no hay peticiones todavía.</h4>
                <p>¡Sé el primero en cambiar el mundo!</p>
                <a href="<?php echo e(route('petitions.create')); ?>" class="btn btn-danger rounded-pill fw-bold">Inicia una petición</a>
            </div>
        <?php else: ?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php $__currentLoopData = $petitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $petition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 petition-card hover-shadow transition">

                            
                            <div class="ratio ratio-16x9">
                                <?php if(count($petition->files) > 0): ?>
                                    
                                    <img src="<?php echo e(asset('petitions/' . basename($petition->files->last()->file_path))); ?>"
                                         class="card-img-top object-fit-cover"
                                         alt="<?php echo e($petition->title); ?>">
                                <?php else: ?>
                                    <img src="https://picsum.photos/seed/<?php echo e($petition->id); ?>/400/250"
                                         class="card-img-top object-fit-cover"
                                         alt="Imagen genérica">
                                <?php endif; ?>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">
                                    <a href="<?php echo e(route('petitions.show', $petition->id)); ?>" class="text-decoration-none text-dark">
                                        <?php echo e(Str::limit($petition->title, 50)); ?>

                                    </a>
                                </h5>

                                
                                <div class="card-author d-flex align-items-center my-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">
                                        <?php echo e(substr($petition->user->name ?? 'A', 0, 1)); ?>

                                    </div>
                                    <span class="small text-muted">por </span>
                                    <span class="fs-6 fw-bold ms-1"><?php echo e($petition->user->name ?? 'Anónimo'); ?></span>
                                </div>

                                <p class="card-text small text-muted">
                                    <?php echo e(Str::limit($petition->description, 90)); ?>

                                </p>
                            </div>

                            <div class="card-footer bg-white border-0 pt-0 pb-4">
                                <div class="progress mb-2" style="height: 6px;">
                                    <?php
                                        $meta = ($petition->signers < 100) ? 100 : $petition->signers + 100;
                                        $percent = ($petition->signers / $meta) * 100;
                                    ?>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo e($percent); ?>%"></div>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold small"><?php echo e(number_format($petition->signers)); ?> firmantes</span>
                                    <span class="text-muted small">meta: <?php echo e(number_format($meta)); ?></span>
                                </div>
                                
                                <?php if(Auth::check() && Auth::id() == $petition->user_id): ?>
                                    <div class="d-flex gap-2">
                                        
                                        <a href="<?php echo e(route('petitions.edit', $petition->id)); ?>" class="btn btn-outline-warning w-50 rounded-pill fw-bold">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>

                                        <form action="<?php echo e(route('petitions.destroy', $petition->id)); ?>" method="POST" class="w-50"
                                              onsubmit="return confirm('¿Estás seguro de que quieres borrar esta petición? No hay vuelta atrás.');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill fw-bold">
                                                <i class="bi bi-trash"></i> Borrar
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/petitions/index.blade.php ENDPATH**/ ?>