<?php
/**
 * Plugin Name: Background Image Slider
 * Description: A simple background slider with overlay text and button.
 * Version: 1.0
 * Author: Your Name
 */

defined('ABSPATH') || exit;

function bis_enqueue_assets()
{
    wp_enqueue_style('bis-slider-style', plugin_dir_url(__FILE__) . 'assets/slider.css');
    wp_enqueue_script('bis-slider-js', plugin_dir_url(__FILE__) . 'assets/slider.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'bis_enqueue_assets');

function bis_slider_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'images' => '',
        'title' => '',
        'desc' => '',
        'button_text' => '',
        'button_url' => '',
        'height' => '500px',
    ), $atts, 'background_slider');

    $images = array_map('trim', explode(',', $atts['images']));

    if (empty($images) || count($images) === 0 || empty($images[0])) {
        return '<p>No images provided for the background slider.</p>';
    }

    $output = '<div class="bis-slider-container" style="height: ' . esc_attr($atts['height']) . ';">';

    // This div will hold the sliding background images
    $output .= '<div class="bis-background-slides">';
    foreach ($images as $i => $img) {
        $output .= '<div class="bis-bg-slide" style="background-image: url(\'' . esc_url($img) . '\');"></div>';
    }
    $output .= '</div>'; // close .bis-background-slides

    // Add the overlay div
    $output .= '<div class="bis-overlay"></div>';

    // --- Conditional Rendering for Fixed Content ---
    // Check if any of the content fields (title, desc, button) are provided
    if (!empty($atts['title']) || !empty($atts['desc']) || !empty($atts['button_text'])) {
        $output .= '<div class="bis-fixed-content">';

        // Only display title if provided
        if (!empty($atts['title'])) {
            $output .= '<h2>' . esc_html($atts['title']) . '</h2>';
        }

        // Only display description if provided
        if (!empty($atts['desc'])) {
            $output .= '<p>' . esc_html($atts['desc']) . '</p>';
        }

        // Only display button if text is provided
        if (!empty($atts['button_text'])) {
            $output .= '<a href="' . esc_url($atts['button_url'] ?? '#') . '" class="btn btn-light effect btn-md">' . esc_html($atts['button_text']) . '</a>';
        }

        $output .= '</div>'; // close .bis-fixed-content
    }
    // --------------------------------------------------

    $output .= '</div>'; // close .bis-slider-container

    return $output;
}
add_shortcode('background_slider', 'bis_slider_shortcode');