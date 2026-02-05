<?php $__env->startSection('content'); ?>
    <div class="container mt-5 mb-5">
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3"><?php echo e($petition->title); ?></h1>

                <div class="d-flex align-items-center mb-4 text-muted">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                        <?php echo e(substr($petition->user->name ?? 'A', 0, 1)); ?>

                    </div>
                    <span class="fw-bold text-dark me-2"><?php echo e($petition->user->name ?? 'Usuario Anónimo'); ?></span>
                    <span>ha iniciado esta petición dirigida a <span class="fw-bold text-dark"><?php echo e($petition->destinatary); ?></span></span>
                </div>

                <div class="ratio ratio-16x9 mb-4 rounded overflow-hidden shadow-sm">
                    
                    <?php if($petition->files->count() > 0): ?>
                        <img src="<?php echo e(asset('petitions/' . $petition->files->first()->name)); ?>"
                             class="object-fit-cover"
                             alt="<?php echo e($petition->title); ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-light text-muted h-100">
                            Sin imagen destacada
                        </div>
                    <?php endif; ?>
                </div>

                <div class="fs-5 text-break">
                    <p><?php echo e($petition->description); ?></p>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="card p-4 shadow-sm sticky-top" style="top: 100px; z-index: 1;">

                    <p class="mb-1">
                        <span class="fw-bold fs-4"><?php echo e(number_format($petition->signers)); ?></span>
                        <span class="text-muted">personas han firmado</span>
                    </p>

                    <div class="progress mb-3" style="height: 10px;">
                        <?php
                            $meta = ($petition->signers < 100) ? 100 : $petition->signers + 100;
                            $percent = ($petition->signers / $meta) * 100;
                        ?>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo e($percent); ?>%;" aria-valuenow="<?php echo e($percent); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <p class="small text-muted mb-4">Ayúdanos a conseguir <?php echo e(number_format($meta)); ?> firmas</p>

                    <?php if(auth()->guard()->check()): ?>
                        
                        <?php if($petition->firmantes->contains(Auth::user()->id)): ?>
                            <div class="alert alert-success text-center fw-bold">
                                <i class="bi bi-check-circle-fill"></i> ¡Ya has firmado!
                            </div>
                        <?php else: ?>
                            <div class="d-grid gap-2">
                                <form action="<?php echo e(route('petitions.firmar', $petition->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-lg w-100 rounded-pill fw-bold">
                                        ¡Firmar esta petición!
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="alert alert-secondary text-center">
                            Debes iniciar sesión para firmar.
                        </div>
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-danger rounded-pill fw-bold">Iniciar sesión</a>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-link text-danger">Registrarse</a>
                        </div>
                    <?php endif; ?>

                    <div class="mt-3 text-center small text-muted">
                        Al firmar, aceptas los términos de servicio.
                    </div>

                </div>

                
                <?php if($petition->firmantes->count() > 0): ?>
                    <div class="mt-4">
                        <h5 class="fw-bold border-bottom pb-2">Últimas firmas</h5>
                        
                        <?php $__currentLoopData = $petition->firmantes->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mt-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 12px;">
                                    <?php echo e(substr($signer->name, 0, 1)); ?>

                                </div>
                                <div>
                                    <p class="mb-0 fw-bold small"><?php echo e($signer->name); ?></p>
                                    <p class="mb-0 text-muted extra-small">firmó recientemente</p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/petitions/show.blade.php ENDPATH**/ ?>