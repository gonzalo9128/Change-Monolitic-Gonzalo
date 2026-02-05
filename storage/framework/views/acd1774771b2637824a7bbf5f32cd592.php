<?php $__env->startSection('content'); ?>
    <div class="container" style="max-width: 600px;">
        <h2 class="mb-4"><?php echo e(isset($category) ? 'Editar Categoría' : 'Nueva Categoría'); ?></h2>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="<?php echo e(isset($category) ? route('admincategorias.update', $category->id) : route('admincategorias.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($category)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input type="text" name="name" class="form-control" value="<?php echo e($category->name ?? ''); ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('admincategorias.index')); ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(isset($category) ? 'Actualizar' : 'Guardar'); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/admin/categorias/edit-add.blade.php ENDPATH**/ ?>