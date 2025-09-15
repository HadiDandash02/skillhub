<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Resume - <?php echo e($name); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.4;
            color: #333;
            background: #fff;
            font-size: 12px;
        }

        .resume-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            display: flex;
            min-height: 297mm;
        }

        /* Left Sidebar */
        .sidebar {
            width: 35%;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 30px 25px;
            position: relative;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 20px;
            height: 100%;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }

        .profile-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 36px;
            font-weight: bold;
            color: white;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        .name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
        }

        .title {
            font-size: 13px;
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .contact-info {
            margin-bottom: 30px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 11px;
        }

        .contact-icon {
            width: 16px;
            margin-right: 12px;
            text-align: center;
            color: #3498db;
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-section:last-child {
            margin-bottom: 0;
        }

        .sidebar-section h3 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #3498db;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .skill-item {
            margin-bottom: 8px;
            font-size: 11px;
        }

        .skill-category {
            font-weight: bold;
            color: #ecf0f1;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        .skill-category:first-child {
            margin-top: 0;
        }

        .skill-list {
            color: #bdc3c7;
            line-height: 1.5;
        }

        .language-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 11px;
        }

        .language-name {
            color: #ecf0f1;
        }

        .language-level {
            color: #bdc3c7;
            font-style: italic;
        }

        .interests-list {
            color: #bdc3c7;
            font-size: 11px;
            line-height: 1.5;
        }

        /* Main Content */
        .main-content {
            width: 65%;
            padding: 30px 35px;
            background: white;
        }

        .summary {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-left: 4px solid #3498db;
            border-radius: 0 8px 8px 0;
        }

        .summary p {
            font-size: 12px;
            line-height: 1.6;
            color: #2c3e50;
            text-align: justify;
        }

        .main-section {
            margin-bottom: 30px;
        }

        .main-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 40px;
            height: 2px;
            background: #e74c3c;
        }

        .experience-item,
        .education-item,
        .project-item {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        .experience-item:last-child,
        .education-item:last-child,
        .project-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .item-title {
            font-size: 13px;
            font-weight: bold;
            color: #2c3e50;
        }

        .item-company,
        .item-institution {
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .item-date {
            font-size: 10px;
            color: #95a5a6;
            font-weight: bold;
            text-align: right;
            min-width: 100px;
        }

        .item-description {
            font-size: 11px;
            line-height: 1.5;
            color: #555;
            text-align: justify;
        }

        .item-description ul {
            margin: 8px 0;
            padding-left: 15px;
        }

        .item-description li {
            margin-bottom: 4px;
        }

        .project-tech {
            font-size: 10px;
            color: #3498db;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Skills in main content */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .skill-category-main {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            border-left: 3px solid #3498db;
        }

        .skill-category-main h4 {
            font-size: 12px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .skill-tag {
            background: #3498db;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }

        /* Print optimization */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .resume-container {
                box-shadow: none;
            }
        }

        /* Responsive adjustments */
        @page {
            margin: 0;
            size: A4;
        }
    </style>
</head>
<body>
    <div class="resume-container">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                    <?php echo e(strtoupper(substr($name, 0, 1))); ?><?php echo e(strtoupper(substr(explode(' ', $name)[1] ?? '', 0, 1))); ?>

                </div>
                <div class="name"><?php echo e($name); ?></div>
                <div class="title"><?php echo e($title ?? 'Professional'); ?></div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div><?php echo e($email); ?></div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">📱</div>
                    <div><?php echo e($phone); ?></div>
                </div>
                <?php if(!empty($location)): ?>
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div><?php echo e($location); ?></div>
                </div>
                <?php endif; ?>
                <?php if(!empty($linkedin)): ?>
                <div class="contact-item">
                    <div class="contact-icon">💼</div>
                    <div style="word-break: break-all;"><?php echo e(str_replace(['https://', 'http://'], '', $linkedin)); ?></div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Skills Section -->
            <?php if(!empty($technical_skills) || !empty($soft_skills)): ?>
            <div class="sidebar-section">
                <h3>Skills</h3>
                
                <?php if(!empty($technical_skills)): ?>
                <div class="skill-category">Technical Skills</div>
                <div class="skill-list">
                    <?php $__currentLoopData = array_map('trim', explode(',', $technical_skills)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($skill)): ?>
                            • <?php echo e($skill); ?><br>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

                <?php if(!empty($soft_skills)): ?>
                <div class="skill-category">Soft Skills</div>
                <div class="skill-list">
                    <?php $__currentLoopData = array_map('trim', explode(',', $soft_skills)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($skill)): ?>
                            • <?php echo e($skill); ?><br>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Languages Section -->
            <?php if(!empty($languages)): ?>
            <div class="sidebar-section">
                <h3>Languages</h3>
                <?php
                    $languageList = array_map('trim', explode(',', $languages));
                ?>
                <?php $__currentLoopData = $languageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($language)): ?>
                        <?php
                            $parts = explode('(', $language);
                            $langName = trim($parts[0]);
                            $langLevel = isset($parts[1]) ? trim(str_replace(')', '', $parts[1])) : 'Proficient';
                        ?>
                        <div class="language-item">
                            <span class="language-name"><?php echo e($langName); ?></span>
                            <span class="language-level"><?php echo e($langLevel); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Interests Section -->
            <?php if(!empty($interests)): ?>
            <div class="sidebar-section">
                <h3>Interests</h3>
                <div class="interests-list">
                    <?php $__currentLoopData = array_map('trim', explode(',', $interests)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($interest)): ?>
                            • <?php echo e($interest); ?><br>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Professional Summary -->
            <div class="summary">
                <p><?php echo e($summary); ?></p>
            </div>

            <!-- Work Experience -->
            <?php if(!empty($experience) && is_array($experience)): ?>
            <div class="main-section">
                <h2 class="section-title">Work Experience</h2>
                <?php $__currentLoopData = $experience; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($exp['title']) || !empty($exp['company'])): ?>
                    <div class="experience-item">
                        <div class="item-header">
                            <div>
                                <?php if(!empty($exp['title'])): ?>
                                <div class="item-title"><?php echo e($exp['title']); ?></div>
                                <?php endif; ?>
                                <?php if(!empty($exp['company'])): ?>
                                <div class="item-company"><?php echo e($exp['company']); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="item-date">
                                <?php if(!empty($exp['start_date'])): ?>
                                    <?php echo e(date('M Y', strtotime($exp['start_date']))); ?>

                                <?php endif; ?>
                                <?php if(!empty($exp['start_date']) && !empty($exp['end_date'])): ?>
                                    - <?php echo e(date('M Y', strtotime($exp['end_date']))); ?>

                                <?php elseif(!empty($exp['start_date']) && empty($exp['end_date'])): ?>
                                    - Present
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!empty($exp['description'])): ?>
                        <div class="item-description">
                            <?php
                                $description = $exp['description'];
                                // Convert bullet points if they exist
                                $lines = explode("\n", $description);
                                $hasBullets = false;
                                foreach($lines as $line) {
                                    if(trim($line) && (strpos(trim($line), '•') === 0 || strpos(trim($line), '-') === 0)) {
                                        $hasBullets = true;
                                        break;
                                    }
                                }
                            ?>
                            
                            <?php if($hasBullets): ?>
                                <ul>
                                    <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(trim($line)): ?>
                                            <li><?php echo e(trim(ltrim(trim($line), '•-'))); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <?php echo e($description); ?>

                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Education -->
            <?php if(!empty($education) && is_array($education)): ?>
            <div class="main-section">
                <h2 class="section-title">Education</h2>
                <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($edu['degree']) || !empty($edu['institution'])): ?>
                    <div class="education-item">
                        <div class="item-header">
                            <div>
                                <?php if(!empty($edu['degree'])): ?>
                                <div class="item-title"><?php echo e($edu['degree']); ?></div>
                                <?php endif; ?>
                                <?php if(!empty($edu['institution'])): ?>
                                <div class="item-institution"><?php echo e($edu['institution']); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="item-date">
                                <?php if(!empty($edu['start_year']) && !empty($edu['end_year'])): ?>
                                    <?php echo e($edu['start_year']); ?> - <?php echo e($edu['end_year']); ?>

                                <?php elseif(!empty($edu['start_year'])): ?>
                                    <?php echo e($edu['start_year']); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!empty($edu['description'])): ?>
                        <div class="item-description"><?php echo e($edu['description']); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <!-- Projects -->
            <?php if(!empty($projects) && is_array($projects)): ?>
            <div class="main-section">
                <h2 class="section-title">Personal Projects</h2>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($project['name'])): ?>
                    <div class="project-item">
                        <div class="item-title"><?php echo e($project['name']); ?></div>
                        <?php if(!empty($project['technologies'])): ?>
                        <div class="project-tech">Technologies: <?php echo e($project['technologies']); ?></div>
                        <?php endif; ?>
                        <?php if(!empty($project['description'])): ?>
                        <div class="item-description"><?php echo e($project['description']); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/resume/pdf.blade.php ENDPATH**/ ?>