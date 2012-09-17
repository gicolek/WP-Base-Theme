<?php

/**
 * Alter comments form default fields via filter
 * The rest is coded in comments.php (can be edited via filter as well)
 * TODO: Add pingback MSS
 */
function custom_comment_fields($fields) {
    $fields['author'] = '<li><label for="name-txt">Name *</label><input type="text" id="author" name="author" value="" /></li>';
    $fields['email'] = '<li><label for="email-txt">Email *</label><input type="text" id="email" name="email" value="" /></li>';
    $fields['url'] = ''; //'<li><label for="website-txt">Website</label><input type="text" id="url" name="url" value="" /></li>';
    return $fields;
}

add_filter( 'comment_form_default_fields', 'custom_comment_fields' );

/* comments display */
if ( !function_exists( 'custom_comment' ) ) :

    /**
     * Template for comments, without pingbacks or trackbacks
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own custom_comment(), and that function will be used instead.
     * 
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * Based on Twenty Eleven Theme
     */
    function custom_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                ?>
                Pingback: <?php comment_author_link(); ?><?php edit_comment_link(); ?>
                <?php
                break;
            default :
                ?>

                <?php
                $avatar_size = 49;
                if ( '0' != $comment->comment_parent )
                    $avatar_size = 49;
                ?>

                <div <?php comment_class( "comment" ); ?> ><?php echo get_avatar( $comment, $avatar_size ); ?>

                    <div class="user-comment" id="comment-<?php comment_ID(); ?>"> 

                        <ul class="meta">
                            <li class="author"><?php echo get_comment_author_link(); ?> says:</li>
                            <li class="time"><a href="#"><?php echo get_comment_date(); ?></a> at <?php echo get_comment_time(); ?></li>
                        </ul>
                        <?php comment_text(); ?> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

                <?php edit_comment_link(); ?>   
                    </div>
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    Your comment is awaiting moderation.

                <?php endif; ?>
                <?php
                break;
        endswitch;
    }

endif; // ends check for ()