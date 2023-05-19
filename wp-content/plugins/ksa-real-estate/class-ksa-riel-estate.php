<?php

class Ksa_Riel_Estate
{

    protected $plugin_name;
    protected $posts_per_page = 3;
    protected $post_type = 'property';

    public function __construct()
    {
        $this->plugin_name = 'ksa-real-estate';
        $this->setup_actions();
    }

    public function setup_actions()
    {
        if (get_option('ksa_riel_estate')) {
            add_action('init', [$this, 'create_post_type__property']);
            add_action('single_template', [$this, 'override_single_template']);
            add_shortcode('property_filter', array($this, 'shortcode_property_filter'));
            add_shortcode('init', array($this, 'register_sidebar'));
            add_filter('widget_text', 'do_shortcode');
            add_action('wp_enqueue_scripts', [$this, 'add_custom_scripts']);
            add_action('wp_ajax_property_filter', [$this, 'property_filter_fun']);
            add_action('wp_ajax_property_filter', [$this, 'property_filter_fun']);
        }
    }

    public function register_sidebar()
    {
        if (function_exists('register_sidebar')) {
            register_sidebar();
        }
    }

    public function add_custom_scripts()
    {
        wp_enqueue_style('ksa-real-estate-style', plugin_dir_url(__FILE__) . 'css/ksa-real-estate.css');
        wp_enqueue_script('ksa-real-estate-js', plugin_dir_url(__FILE__) . 'js/ksa-real-estate.js', array('jquery'), null, true);
        wp_localize_script('ksa-real-estate-js', 'ksaRealEstateAjaxurl',
            array(
                'url' => admin_url('admin-ajax.php'),
            )
        );
    }

    public function override_single_template( $single_template ){
//        global $post;

        $pattern = "~.+(\/|\\\)(.+.php)~";
        preg_match( $pattern, $single_template, $matches);
//        var_dump($single_template, $matches[2]);
//        die;
        if($this->post_type == get_post_type(get_queried_object_id())
            && $this->post_type .'.php' != $matches[2]) {
            $file = dirname(__FILE__) .'/templates/single-'. $this->post_type .'.php';
            if( file_exists( $file ) ) $single_template = $file;

            return $single_template;
        }

        return $single_template;
    }

    public function create_post_type__property()
    {

        $labels = [
            'name' => _x('Districts', 'taxonomy general name'),
            'singular_name' => _x('District', 'taxonomy singular name'),
            'search_items' => __('Search Districts'),
            'all_items' => __('All Districts'),
            'parent_item' => __('Parent District'),
            'parent_item_colon' => __('Parent District:'),
            'edit_item' => __('Edit District'),
            'update_item' => __('Update District'),
            'add_new_item' => __('Add New District'),
            'new_item_name' => __('New District Name'),
            'menu_name' => __('Districts'),
        ];
        register_taxonomy('district', [$this->post_type], [
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'type'),
        ]);


        $labels = array(
            'name' => __('Property'),
            'singular_name' => __('Property'),
            'add_new' => __('Add New Property'),
            'add_new_item' => __('Add New Property'),
            'edit_item' => __('Edit Property'),
            'new_item' => __('New Property'),
            'all_items' => __('All Property'),
            'view_item' => __('View Property'),
            'search_items' => __('Search Property'),
            'not_found' => __('No Property Found'),
            'not_found_in_trash' => __('No Property found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => __('Property'),
        );
        //register post type
        register_post_type($this->post_type, array(
                'labels' => $labels,
                'has_archive' => true,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes'),
                'taxonomies' => array('district'),
                'exclude_from_search' => false,
                'capability_type' => 'post',
                'rewrite' => array('slug' => 'Property'),
            )
        );
    }

    public function shortcode_property_filter()
    {
        $field = get_field_object('field_6466c153e528f');

        return $this->shortcode_template($field['choices']);
    }

    private function shortcode_template($floors)
    {
        return $this->render('shortcode_form', compact('floors'));
    }

    public function render($fileName, $params = false)
    {
        $template = __DIR__ . '/templates/' . $fileName . '.php';
        if (file_exists($template)) {
            if ($params) {
                extract($params);
            }
            ob_start();
            require($template);

            return ob_get_clean();
        }

        return '';
    }

    public function property_filter_fun()
    {
        $params = $_POST;

        $formField = [];
        $formField['relation'] = 'AND';
        if ($params['name_house'] != '') {
            $formField[] = [
                'key' => 'name_house',
                'value' => $params['name_house'],
                'compare' => 'LIKE',
            ];
        }
        if ($params['location_coordinates'] != '') {
            $formField[] = [
                'key' => 'location_coordinates',
                'value' => $params['location_coordinates'],
                'compare' => '= ',
            ];
        }
        if ($params['floor'] != '') {
            $formField[] = [
                'key' => 'number_of_floors',
                'value' => $params['floor'],
                'compare' => '= ',
            ];
        }

        $paged = (int)isset($params['page']) ? $params['page'] : 1;
        $args = [
            'post_type' => 'property',
            'meta_query' => $formField,
            'posts_per_page' => $this->posts_per_page,
            'paged' => $paged

        ];

        $query = new WP_Query($args);
        $max_num_pages = $query->max_num_pages;

        if ($query->have_posts()) {
            $result['html'] = $this->render('list_property',
                [
                    'query' => $query,
                ]);
            $result['html'] .= $this->render('paginate',
                [
                    'posts_per_page' => $this->posts_per_page,
                    'current' => $paged,
                    'total' => $max_num_pages,
                ]);

            wp_reset_postdata();
        } else {
            $result = [
                'html' => '<p>' . __('no search result') . '</p>',
            ];
        }

        return wp_send_json_success($result);
        die;

    }
}