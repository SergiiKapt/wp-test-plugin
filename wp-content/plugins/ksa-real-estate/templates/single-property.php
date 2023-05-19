<?php

get_header();

while (have_posts()) :
    the_post();
    $postId = get_the_ID();
    ?>
    <article id="post-<?php the_ID(); ?>">
        <?php
        echo '<h1>' . get_the_title() . '</h1>';
        $terms = get_the_terms($postId, 'district');
        if ($terms) {
            $taxs = [];
            foreach ($terms as $term) {
                $taxs[] = $term->name;
            }
            echo implode(', ', $taxs);
        }

        the_content();

        echo '<p> Name house: ' . get_field('name_house', $postId) ?: "". '</p>';
        echo '<p> Location coordinates: ' . get_field('location_coordinates', $postId) ?: "". '</p>';
        echo '<p> Number of floors: ' . get_field('number_of_floors', $postId) ?: "" . '</p>';

        ?>
    </article>
<?php
endwhile; // End of the loop.

get_footer();