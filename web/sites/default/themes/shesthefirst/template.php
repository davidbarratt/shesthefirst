<?php

/**
 * Implements template_preprocess_html().
 */
function shesthefirst_preprocess_html(&$variables) {

  // Add the Google Fonts.
  $url = '//fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,700italic';
  $options = array(
    'type' => 'external',
  );

  drupal_add_css($url, $options);

  // Make the Page Responsive.
  $element = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1',
    ),
  );
  drupal_add_html_head($element, 'viewport');

}


/**
 * Implements template_preprocess_page().
 */
function shesthefirst_preprocess_page(&$variables) {

  // Remove the Menu's
  $variables['main_menu'] = '';
  $variables['secondary_menu'] = '';

  // Remove the Site Name & Slogan
  $variables['site_name'] = FALSE;
  $variables['site_slogan'] = FALSE;

  // Remove the Breadcrumb
  $variables['breadcrumb'] = '';

  // Remove the Title
  $variables['title_prefix'] = array();
  $variables['title'] = '';
  $variables['title_suffix'] = array();

  // Remove the Sidebars.
  $variables['page']['highlighted'] = array();
  $variables['page']['sidebar_first'] = array();
  $variables['page']['sidebar_second'] = array();

}

/*
 * Implements theme_date_combo().
 */
function shesthefirst_date_combo(&$variables) {
  return theme('form_element', $variables);
}
