<?php $__env->startSection('content'); ?>
    <main class="hero-section position-relative">

        
        <div class="hero-content text-center">
            <h1 class="display-4 fw-bold mb-3">El altavoz más grande del mundo</h1>
            <p class="lead fs-4 mb-4">Inicia una petición para pedirle a quienes toman las decisiones lo que quieres cambiar.</p>
            <a href="<?php echo e(route('petitions.create')); ?>" class="btn btn-danger btn-lg rounded-pill px-5 py-3 fw-bold">
                Iniciar una petición
            </a>
        </div>

        
        
        <div id="p1" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="<?php echo e(asset('assets/img/circulo1.jpg')); ?>" class="rounded-circle shadow-lg" alt="Petición Abejas">
            <p class="mt-2 fw-bold small">"Salva a las abejas"</p>
        </div>

        
        <div id="p2" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="<?php echo e(asset('assets/img/circulo1.jpg')); ?>" class="rounded-circle shadow-lg" alt="Petición Parques">
            <p class="mt-2 fw-bold small">"Parques para todos"</p>
        </div>

        
        <div id="p3" class="petition-bubble position-absolute d-none d-md-block">
            <img src="<?php echo e(asset('assets/img/circulo1.jpg')); ?>" class="rounded-circle shadow-lg" alt="Petición Transporte">
            <p class="mt-2 fw-bold small">"Transporte público"</p>
        </div>

        
        <div id="p4" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="<?php echo e(asset('assets/img/circulo1.jpg')); ?>" class="rounded-circle shadow-lg" alt="Petición Agua">
            <p class="mt-2 fw-bold small">"Agua limpia ya"</p>
        </div>

        
        <div id="p5" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="<?php echo e(asset('assets/img/circulo1.jpg')); ?>" class="rounded-circle shadow-lg" alt="Petición Reciclaje">
            <p class="mt-2 fw-bold small">"Reciclaje obligatorio"</p>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/pages/home.blade.php ENDPATH**/ ?>