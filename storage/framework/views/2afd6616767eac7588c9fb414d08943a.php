<?php $__env->startSection('content'); ?>
    <h2 class="mb-4 fw-bold"> Gestión de Usuarios</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol Actual</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-4"><?php echo e($user->id); ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                    <?php echo e(substr($user->name, 0, 1)); ?>

                                </div>
                                <?php echo e($user->name); ?>

                            </div>
                        </td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php if($user->role_id == 2): ?>
                                <span class="badge bg-danger">ADMIN</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Usuario</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">

                            <?php if($user->id != Auth::id()): ?>
                                <form action="<?php echo e(route('adminusers.role', $user->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <?php if($user->role_id == 1): ?>
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Hacer Admin">
                                             Ascender
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Quitar Admin">
                                             Eliminar
                                        </button>
                                    <?php endif; ?>
                                </form>

                                <form action="<?php echo e(route('adminusers.delete', $user->id)); ?>" method="POST" class="d-inline ms-1">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted small fst-italic">Tu cuenta</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Alumno\PhpstormProjects\change_Monolitic_Gonzalo (1)\change_Monolitic_Gonzalo_final\resources\views/admin/users/index.blade.php ENDPATH**/ ?>