<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="container">
        
        <h2><?php echo e(isset($petition) ? 'Editar Petición' : 'Nueva Petición'); ?></h2>

        
        <?php if(isset($petition)): ?>
            <form action="<?php echo e(route('adminpeticiones.update', $petition->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php else: ?>
                    <form action="<?php echo e(route('adminpeticiones.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php endif; ?>

                        <?php echo csrf_field(); ?>

                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" value="<?php echo e($petition->title ?? ''); ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Selecciona una categoría...</option>
                                
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                        <?php echo e((isset($petition) && $petition->category_id == $category->id) ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        
                        <div class="mb-3">
                            <label for="destinatary" class="form-label">Destinatario (A quién va dirigida)</label>
                            <input type="text" name="destinatary" class="form-control" value="<?php echo e($petition->destinatary ?? ''); ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="5" required><?php echo e($petition->description ?? ''); ?></textarea>
                        </div>

                        
                        <?php if(isset($petition)): ?>
                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <select name="status" class="form-select">
                                    
                                    <?php $currentState = $petition->status ?? $petition->state; ?>
                                    <option value="pending" <?php echo e($currentState == 'pending' ? 'selected' : ''); ?>>Pendiente</option>
                                    <option value="accepted" <?php echo e($currentState == 'accepted' ? 'selected' : ''); ?>>Aceptada</option>
                                    <option value="rejected" <?php echo e($currentState == 'rejected' ? 'selected' : ''); ?>>Rechazada</option>
                                </select>
                            </div>
                        <?php endif; ?>

                        
                        <div class="mb-3">
                            <label for="file" class="form-label">Imagen</label>
                            <input type="file" name="file" class="form-control">
                            <?php if($petition->files->count() > 0): ?>
                                <div class="form-text text-success">
                                    Imagen actual: <?php echo e($petition->files->first()->name); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(isset($petition) ? 'Actualizar' : 'Guardar'); ?>

                        </button>

                        <a href="<?php echo e(route('adminpeticiones.index')); ?>" class="btn btn-secondary">Cancelar</a>

                    </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/admin/peticiones/edit-add.blade.php ENDPATH**/ ?>