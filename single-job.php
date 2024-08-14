<?php get_header(); ?>

<div class="job-listings-container">
    <h1><?php the_title(); ?></h1>

    <p><strong>Job Title:</strong> <?php echo get_post_meta(get_the_ID(), 'job_title', true); ?></p>
    <p><strong>Salary:</strong> <?php echo get_post_meta(get_the_ID(), 'salary', true); ?></p>
    <p><strong>Location:</strong> <?php echo get_post_meta(get_the_ID(), 'location', true); ?></p>

    <div>
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>
