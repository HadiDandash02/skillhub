<!-- resources/views/learningPathsResults.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="learning-paths-results-container">
    <h2 class="results-title">Learning Paths Results</h2>

    <div class="courses-section">
        <h3>Courses Based on Your Interests and Skill Level</h3>
        <?php if($courses->isEmpty()): ?>
            <p class="no-results-message">No courses found based on your selection.</p>
        <?php else: ?>
            <div class="courses-list">
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="course-card">
                        <h4 class="course-title"><?php echo e($course->title); ?></h4>
                        <p class="course-category"><strong>Category:</strong> <?php echo e($course->category); ?></p>
                        <p class="course-difficulty"><strong>Difficulty:</strong> <?php echo e(ucfirst($course->difficulty)); ?></p>
                        <p class="course-description"><?php echo e($course->description); ?></p>
                        <a href="<?php echo e(route('courses.show', $course->id)); ?>" class="btn btn-primary" id="LPS-button">Learn More</a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/learningPathsResults.blade.php ENDPATH**/ ?>