<?php

/**
 * Impliments hook_migrate_api().
 */
function shesthefirst_migrate_migrate_api() {
  $api = array(
    'api' => 2,
    'groups' => array(
      'shesthefirst' => array(
        'title' => t("She's the First"),
      ),
    ),
    'migrations' => array(
      'ShesTheFirstContact' => array(
        'class_name' => 'ShesTheFirstContactMigration',
        'group_name' => 'shesthefirst',
      ),
    ),
  );
  return $api;
}
