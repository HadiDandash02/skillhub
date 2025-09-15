

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit User</h1>

    <form method="POST" action="<?php echo e(route('admin.updateUser', $user->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo e($user->email); ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user" <?php echo e($user->role === 'user' ? 'selected' : ''); ?>>User</option>
                <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/admin/edit-user.blade.php ENDPATH**/ ?>