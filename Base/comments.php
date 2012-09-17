<?php
/**
 * The template for displaying Comments.
 *
 * Comments are modified via $defaults array defined at the bottom
 * and functions php via add_filter( 'comment_form_default_fields', 'custom_comment_fields' ); hook 
 * 
 * TODO: http://codex.wordpress.org/Function_Reference/wp_list_commentss
 * 
 * @package WordPress
 * @subpackage Skeleton
 * 
 * (Yeah I copied this code from Twenty Eleven - no need to play Sherlock Holmes)
 */
?>

<?php if ( post_password_required() ) : ?>
    This post is password protected. Enter the password to view any comments.
    <?php
    /* Stop the rest of comments.php from being processed,
     * but don't kill the script entirely -- we still have
     * to fully load the template.
     */
    return;
endif;
?>

<?php if ( have_comments() ) : ?>

    <?php
    /*
     * List comments acording to custom_comment function specified 
     * in commentstemplate.php file
     */
    ?>
    <?php wp_list_comments( array( 'callback' => 'custom_comment' ) ); ?>

    <?php
    /*
     * Alter default values of form field
     * Name, Author and URL are edited in functions.php via
     * comment_form_default_fields filter hook
     */

    $defaults = array(
        'comment_field' => '<li><label for="message-txt">Message</label><textarea cols="87" rows="7" id="comment" name="comment"></textarea></li>',
        'must_log_in' => '<p class="must-log-in">You must log in to post a comment.',
        'logged_in_as' => '<p class="logged-in-as">Logged in.',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'id_form' => 'commentform',
        'id_submit' => 'button-add-comment',
        'title_reply' => __( 'Leave a reply' ),
        'title_reply_to' => __( 'Leave a Reply to %s' ),
        'cancel_reply_link' => __( 'Cancel comment' ),
        'label_submit' => __( 'Comment' ),
    );
    ?>

    <?php comment_form( $defaults ); ?>

    <?php
/* If there are no comments and comments are closed, let's leave a little note, shall we?
 * But we don't want the note on pages or post types that do not support comments.
 */
elseif ( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
    Comments closed
<?php endif; ?>

