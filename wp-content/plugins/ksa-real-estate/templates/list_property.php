<?php

echo '<ul class="propery_filter_list">';
while ($query->have_posts()) {
    $query->the_post();

    $postId = get_the_ID();

    echo '<li>';
    echo '<a href="' . get_permalink() . '"><h2>' . get_the_title() . '</h2></a>';

    $terms = get_the_terms($postId, 'district');
    if ($terms) {
        $taxs = [];
        foreach ($terms as $term) {
            $taxs[] = $term->name;
        }
        echo implode(', ', $taxs);
    }
    echo '<p> Name house: ' . get_field('name_house', $postId) . '</p>';
    echo '<p> location coordinates: ' . get_field('location_coordinates', $postId) . '</p>';
    echo '<p> number of floors: ' . get_field('number_of_floors', $postId) . '</p>';
    echo '</li>';
}

echo '</ul>';



