<?php get_header(); ?>

<div class="job-listings-container">
    <h1>Job Listings</h1>

    <?php if ( have_posts() ) : ?>
        <ul class="job-listings">
            <?php while ( have_posts() ) : the_post(); ?>
                <li class="job-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><strong>Job Title:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'job_title', true)); ?></p>
                    <p><strong>Salary:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'salary', true)); ?></p>
                    <p><strong>Location:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'location', true)); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>

        <div class="pagination">
            <?php
            echo paginate_links(array(
                'prev_text' => __('&laquo; Previous', 'textdomain'),
                'next_text' => __('Next &raquo;', 'textdomain'),
            ));
            ?>
        </div>

    <?php else : ?>
        <p>No jobs found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
