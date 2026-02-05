<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"> Gestión de Categorías</h2>
        <a href="<?php echo e(route('admincategorias.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Categoría
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nombre</th>
                    <th class="text-center">Peticiones Activas</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-4"><?php echo e($category->id); ?></td>
                        <td class="fw-bold"><?php echo e($category->name); ?></td>
                        <td class="text-center">
                            <span class="badge bg-secondary"><?php echo e($category->petitions->count()); ?></span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="<?php echo e(route('admincategorias.edit', $category->id)); ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admincategorias.delete', $category->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que quieres borrarla?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/admin/categorias/index.blade.php ENDPATH**/ ?>