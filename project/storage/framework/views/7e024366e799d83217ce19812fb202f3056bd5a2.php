

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="header-container">
        <h1 class="manage-title">Manage Quizzes</h1>
        <a href="<?php echo e(route('admin.quizzes.create')); ?>" class="btn btn-primary btn-add-quiz">
            <i class="fas fa-plus-circle"></i> Add Quiz
        </a>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchQuizInput" class="search-input" placeholder="Search quizzes by title...">
    </div>
    
    <div class="table-responsive">
        <table class="table quiz-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="quizTableBody">
                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($quiz->id); ?></td>
                    <td><?php echo e($quiz->title); ?></td>
                    <td><?php echo e($quiz->created_at->format('M d, Y')); ?></td>
                    <td class="action-buttons">
                        <a href="<?php echo e(route('admin.quizzes.edit', $quiz->id)); ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="<?php echo e(route('admin.quizzes.destroy', $quiz->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <a href="<?php echo e(route('quiz.show', $quiz->id)); ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .manage-title {
        margin: 0;
        font-size: 2rem;
        color: #333;
    }

    .btn-add-quiz {
        padding: 12px 16px;
        border: none;
        cursor: pointer;
        border-radius: 25px;
        text-decoration: none;
        color: white;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        background: #4f46e5;
    }

    .btn-add-quiz:hover {
        background: #6b63ff;
        transform: translateY(-2px);
    }

    .btn-add-quiz i {
        margin-right: 8px;
    }

    .search-container {
        text-align: center;
        margin-bottom: 25px;
    }

    .search-input {
        width: 60%;
        padding: 12px;
        border-radius: 25px;
        border: 2px solid #4f46e5;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-input:focus {
        border-color: #6b63ff;
    }

    .quiz-table {
        width: 100%;
        border-collapse: separate;
        background: white;
        border-radius: 12px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .quiz-table th, .quiz-table td {
        padding: 14px;
        text-align: center;
        border: 1px solid #d2d0d0;
    }

    .quiz-table th {
        background-color: #4f46e5;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
    }

    .quiz-table tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .btn {
        padding: 12px 16px;
        border: none;
        cursor: pointer;
        border-radius: 25px;
        text-decoration: none;
        color: white;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-warning { 
        background: #ffc107; 
        color: #212529;
    }

    .btn-warning:hover {
        background: #e0a800;
        color: white;
    }

    .btn-danger { 
        background: #dc3545; 
    }
    .btn-info { 
        background: #17a2b8; 
    }
    .btn-danger:hover {
        background: #c82333;
    }

    .btn i { 
        margin-right: 8px; 
    }

    /* Responsive Design */
    @media (max-width: 806px) {
        .header-container {
            flex-direction: column;
            gap: 15px;
        }
        
        .btn-add-quiz {
            width: 100%;
            justify-content: center;
        }

        .search-input {
            width: 80%;
        }

        .btn {
            padding: 10px 14px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 680px) {
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .quiz-table {
            min-width: 600px;
            white-space: nowrap;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            white-space: nowrap;
        }
        
        .quiz-table th, 
        .quiz-table td {
            padding: 12px !important;
        }
        
        .search-input {
            width: 90%;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchQuizInput');
        
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll("#quizTableBody tr");
            
            rows.forEach(row => {
                const title = row.cells[1].textContent.toLowerCase();
                row.style.display = title.includes(searchText) ? "" : "none";
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/admin/quizzes/index.blade.php ENDPATH**/ ?>