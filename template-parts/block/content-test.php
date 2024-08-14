<?php
/**
 * Block Name: test
 *
 * This is the template that displays the test block.
 */

$block_test_visible = get_field('block_test_visible');
$block_test_title = get_field('block_test_title');
$block_test_image = get_field('block_test_image');

?>
<?php if( $block_test_visible ) { ?>
    <div class="test-block">
        <div class="row1920">
            <?php if( $block_test_title ) { ?>
                <h2>
                    <?php echo $block_test_title; ?>
                </h2>
            <?php } ?>
            <?php
            $image = $block_test_image;
            if( !empty( $image ) ): ?>
                <div class="img-wrap">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>

