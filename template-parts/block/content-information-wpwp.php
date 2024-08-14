<?php
/**
 * Block Name: information-wpwp
 *
 * This is the template that displays the test block.
 */


$visible = get_field('visible');
$title = get_field('ttile');
$desc = get_field('desc');
$button1 = get_field('button_1');
$button2 = get_field('button_2');
$social = get_field('social');
$numberHistory = get_field('number_history');
$numberDay = get_field('number_day');
$numberDie = get_field('number_die');

?>

<?php if ($visible) { ?>
    <div class="information-block">
        <div class="row1320">
            <div class="wrapper">
                <?php if ($title || $desc || $button1 || $button2) { ?>
                    <div class="left-content">
                        <?php if ($title) { ?>
                            <h1>
                                <?php echo $title; ?>
                            </h1>
                        <?php } ?>
                        <?php if ($title) { ?>
                            <p>
                                <?php echo $desc; ?>
                            </p>
                        <?php } ?>
                        <?php if ($button1 || $button2) { ?>
                            <div class="wrapper-buttons">
                                <?php
                                $link = $button1;
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="button-wpwp" href="<?php echo esc_url($link_url); ?>"
                                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                <?php endif; ?>
                                <?php
                                $link = $button2;
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="button-wpwp" href="<?php echo esc_url($link_url); ?>"
                                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if( $social || $numberHistory || $numberDay || $numberDie ) { ?>
                    <div class="right-content">
                        <?php if ($block = $social) { ?>
                            <div class="social">
                                <ul>
                                    <?php foreach ($block as $block_item) { ?>
                                        <li>
                                            <a href="<?php echo $block_item['url'] ?>">
                                                <img src="<?php echo $block_item['icon'] ?>" alt="">
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <?php if( $numberHistory || $numberDay || $numberDie ) { ?>
                            <div class="info">
                                <?php if( $numberHistory ) { ?>
                                    <div class="column">
                            <span class="number">
                                <?php echo $numberHistory; ?>
                            </span>
                                        <span class="text">
                                Историй на сайте
                            </span>
                                    </div>
                                <?php } ?>
                                <?php if( $numberDay ) { ?>
                                    <div class="column">
                            <span class="number">
                                <?php echo $numberDay; ?>
                            </span>
                                        <span class="text">
                                Дней войны
                            </span>
                                    </div>
                                <?php } ?>
                                <?php if( $numberDie ) { ?>
                                    <div class="column">
                            <span class="number">
                                <?php echo $numberDie; ?>
                            </span>
                                        <span class="text">
                                Погибших
                            </span>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
