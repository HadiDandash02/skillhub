

<?php $__env->startSection('content'); ?>
<div class="container">
    
        <h1 class="page-title">Manage Interactive Challenges</h1>
       
    

    <table class="table challenge-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $challenges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $challenge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($challenge->id); ?></td>
                <td><?php echo e($challenge->title); ?></td>
                <td><?php echo e($challenge->created_at->format('M d, Y')); ?></td>
                <td class="actions">
                    <button type="button" class="btn btn-edit" onclick="window.location.href='<?php echo e(route('admin.challenges.edit', $challenge->id)); ?>'">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="<?php echo e(route('admin.challenges.destroy', $challenge->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    <a href="<?php echo e(route('challenge.show', $challenge->id)); ?>" class="btn btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="button-container">
    <a href="<?php echo e(route('admin.challenges.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Challenge
    </a>
    </div>
</div>

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.container {
    max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
}

.button-container {
    margin-top: 10px;
    }

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.page-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 2rem;
        color: #333;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
    }

.btn-primary {
    background: #4f46e5;
    color: white;
}

.btn-primary:hover {
    background: #3c36b5;
}

.btn-edit {
    background: #ffc107;
    color: #2c3e50;
}

.btn-edit:hover {
    background: #e0a800;
}
.btn-info { 
        background: #17a2b8; 
    }
.btn-delete {
    background: #dc3545;
    color: white;
    border: none;
}

.btn-delete:hover {
    background: #c82333;
}

.challenge-table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.challenge-table th, .challenge-table td {
    padding: 15px;
    text-align: left;
}

.challenge-table th {
    background-color: #4f46e5;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.challenge-table tbody tr:hover {
    background: #f8f9fa;
}

.actions {
    display: flex;
    gap: 10px;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/admin/challenges/index.blade.php ENDPATH**/ ?>