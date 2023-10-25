<?php
/*
Plugin name: Blog Subsription WP
Description:  A simple blog Subcription system.
Version: 1.0
Author Name: Ashish Kumar
*/

function subscription_form() {
    ob_start(); ?>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Enter Your Email" required>
        <input type="submit" value="subscribe">
    </form>
    <?php
    return ob_get_clean();

}

add_shortcode('subcription_form', 'subscription_form');

function handle_subcription_form() {
    if (isset($_POST[email])) {
        $email = sanitize_email($_POST['email']);
        $subcribers = get_option('blog_subscribers', array());
        if (!in_array($email,subscribers))  {
            $subcribers[] = $email;
            update_option('blog_subscribers', $subcribers);

        }
        //you can also send a confrimation email to the subscriber

    }
}

add_action('init', 'handle_subscription_form');


function send_email_notifications($post_ID) {
    $subcribers = get_option('blog_subcribers', array());
    $post_title = get_the_title($post_ID);
    $post_url = get_permalink($post_ID);
    $subject = 'New Blog Post: ' . $post_title;
    $message = "A new blog post has been published:\n\n";
    $message .= $post_title . "\n";
    $message .= $post_url . "\n";
    foreach ($subscribers as $email) {
        wp_mail($email, $subject, $message);
    }
}
add_action('publish_post', 'send_email_notifications');
}