<?php get_header(); ?>

<div class="job-listings-container">
    <h1><?php the_title(); ?></h1>

    <?php
    $job_title = get_post_meta(get_the_ID(), 'job_title', true);
    $salary = get_post_meta(get_the_ID(), 'salary', true);
    $location = get_post_meta(get_the_ID(), 'location', true);
    ?>

    <?php if (!empty($job_title)): ?>
        <p><strong>Job Title:</strong> <?php echo esc_html($job_title); ?></p>
    <?php endif; ?>

    <?php if (!empty($salary)): ?>
        <p><strong>Salary:</strong> <?php echo esc_html($salary); ?></p>
    <?php endif; ?>

    <?php if (!empty($location)): ?>
        <p><strong>Location:</strong> <?php echo esc_html($location); ?></p>
    <?php endif; ?>

    <div>
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>
