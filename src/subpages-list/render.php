<?php 

if(!function_exists('render_subpages')){
    function render_subpages($attributes) {
        if (!is_page()) return '';

        global $post;
        $parent_id = $post->ID;
    
        $args = array(
            'post_type'      => 'page',
            'post_parent'    => $parent_id,
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'orderby'        => 'menu_order',
        );
    
        $child_pages = get_posts($args);
    
        if (!$child_pages) return '<p>No subpages found.</p>';

     ob_start();
    ?>
    <nav <?php echo get_block_wrapper_attributes(); ?>>
        <ul>
            <?php foreach ($child_pages as $page) : 
                $active_class = ($post->ID === $page->ID) ? 'current-menu-item' : ''; ?>
                <li class="<?php echo esc_attr($active_class); ?>">
                    <a href="<?php echo esc_url(get_permalink($page->ID)); ?>">
                        <?php echo esc_html(get_the_title($page->ID)); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php
    return ob_get_clean();
    }
}

echo render_subpages($attributes);

?>