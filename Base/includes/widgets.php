<?php
/*
 * Widgets file
 * 1.=Widget for testimonials post type with multi select
 * 
 */

/* 1.=Widget for testimonials post type
  --------------------------------------------- */

class Testimonials_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'testimonials_widget', // Base ID
                'Testimonials_Widget', // Name
                array( 'description' => __( 'Widget to display Testimonials.', 'text_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        // todo debug
        $testimonials = $instance['testimonials'];

        echo $before_widget;
        if ( !empty( $title ) )
            echo $before_title . $after_title;
        ?>
        <?php
        // pick one random posts from the posts selected via widget template
        $ids = $testimonials;

        $limit = count( $ids );

        $post = rand( 0, $limit - 1 );

        query_posts( array( 'p' => $ids[$post], 'post_type' => 'testimonials' ) );

        // the Loop
        while ( have_posts() ) : the_post();
            ?>
            <q> <?php the_content(); ?> </q>
            <cite><?php the_title(); ?></cite>
        <?php endwhile; ?><?php
        echo $after_widget;
        wp_reset_query();
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array( );
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['testimonials'] = $new_instance['testimonials'];
        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            $title = __( 'New title', 'text_domain' );
        }

        if ( isset( $instance['testimonials'] ) ) {
            $testimonials = $instance['testimonials'];
        } else {
            $testimonials = array( 'dupa' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p><select id="<?php echo $this->get_field_id( 'testimonials' ); ?>" name="<?php echo $this->get_field_name( 'testimonials' ); ?>[]" multiple="multiple" >
                <optgroup label="<?php echo esc_attr( __( 'Testimonials' ) ); ?>">
                    <?php
                    global $post;
                    $args = array( 'post_type' => 'testimonials' );
                    $myposts = get_posts( $args );
                    foreach ( $myposts as $post ) : setup_postdata( $post );
                        ?>
                        <option <?php if ( in_array( $post->ID, $testimonials ) !== FALSE ): ?> < selected="selected" <?php endif; ?>  value="<?php echo $post->ID; ?>"><?php the_title(); ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select></p>

        <?php
    }

}

// class Testimonials_Widget

add_action( 'widgets_init', create_function( '', 'register_widget( "testimonials_widget" );' ) );

?>
