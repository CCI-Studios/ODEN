<?php
// @codingStandardsIgnoreFile

/**
 * @file
 * Contains database additions to drupal-8.bare.standard.php.gz for testing the
 * upgrade path of https://www.drupal.org/node/2786577.
 */

use Drupal\Core\Database\Database;

$connection = Database::getConnection();

// Update core.entity_form_display.node.page.default
$data = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.entity_form_display.node.page.default')
  ->execute()
  ->fetchField();

$data = unserialize($data);
$data['dependencies']['config'][] = 'field.field.node.page.field_range';
$data['dependencies']['module'][] = 'datetime_range';
$data['content']['field_range'] = array(
    "weight"=> 27,
    "settings" => array(),
    "third_party_settings" => array(),
    "type" => "daterange_default",
    "region" => "content"
);
$connection->update('config')
  ->fields([
    'data' => serialize($data),
  ])
  ->condition('collection', '')
  ->condition('name', 'core.entity_form_display.node.page.default')
  ->execute();

// Update core.entity_view_display.node.page.default
$data = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.entity_view_display.node.page.default')
  ->execute()
  ->fetchField();

$data = unserialize($data);
$data['dependencies']['config'][] = 'field.field.node.page.field_range';
$data['dependencies']['module'][] = 'datetime_range';
$data['content']['field_range'] = array(
    "weight"=> 102,
    "label"=> "above",
    "settings" => array("separator"=> "-", "format_type" => "medium", "timezone_override" => ""),
    "third_party_settings" => array(),
    "type" => "daterange_default",
    "region" => "content"
);
$connection->update('config')
  ->fields([
    'data' => serialize($data),
  ])
  ->condition('collection', '')
  ->condition('name', 'core.entity_view_display.node.page.default')
  ->execute();

$connection->insert('config')
->fields(array(
  'collection',
  'name',
  'data',
))
->values(array(
  'collection' => '',
  'name' => 'field.field.node.page.field_range',
  'data' => 'a:16:{s:4:"uuid";s:36:"87dc4221-8d56-4112-8a7f-7a855ac35d08";s:8:"langcode";s:2:"en";s:6:"status";b:1;s:12:"dependencies";a:2:{s:6:"config";a:2:{i:0;s:30:"field.storage.node.field_range";i:1;s:14:"node.type.page";}s:6:"module";a:1:{i:0;s:14:"datetime_range";}}s:2:"id";s:21:"node.page.field_range";s:10:"field_name";s:11:"field_range";s:11:"entity_type";s:4:"node";s:6:"bundle";s:4:"page";s:5:"label";s:5:"range";s:11:"description";s:0:"";s:8:"required";b:0;s:12:"translatable";b:0;s:13:"default_value";a:0:{}s:22:"default_value_callback";s:0:"";s:8:"settings";a:0:{}s:10:"field_type";s:9:"daterange";}',
))
->values(array(
  'collection' => '',
  'name' => 'field.storage.node.field_range',
  'data' => 'a:16:{s:4:"uuid";s:36:"2190ad8c-39dd-4eb1-b189-1bfc0c244a40";s:8:"langcode";s:2:"en";s:6:"status";b:1;s:12:"dependencies";a:1:{s:6:"module";a:2:{i:0;s:14:"datetime_range";i:1;s:4:"node";}}s:2:"id";s:16:"node.field_range";s:10:"field_name";s:11:"field_range";s:11:"entity_type";s:4:"node";s:4:"type";s:9:"daterange";s:8:"settings";a:1:{s:13:"datetime_type";s:8:"datetime";}s:6:"module";s:14:"datetime_range";s:6:"locked";b:0;s:11:"cardinality";i:1;s:12:"translatable";b:1;s:7:"indexes";a:0:{}s:22:"persist_with_no_fields";b:0;s:14:"custom_storage";b:0;}',
))
->values(array(
  'collection' => '',
  'name' => 'views.view.test_datetime_range_filter_values',
  'data' => 'a:13:{s:4:"uuid";s:36:"d20760b6-7cc4-4844-ae04-96da7225a46f";s:8:"langcode";s:2:"en";s:6:"status";b:1;s:12:"dependencies";a:1:{s:6:"module";a:2:{i:0;s:4:"node";i:1;s:4:"user";}}s:2:"id";s:33:"test_datetime_range_filter_values";s:5:"label";s:33:"test_datetime_range_filter_values";s:6:"module";s:5:"views";s:11:"description";s:0:"";s:3:"tag";s:0:"";s:10:"base_table";s:15:"node_field_data";s:10:"base_field";s:3:"nid";s:4:"core";s:3:"8.x";s:7:"display";a:1:{s:7:"default";a:6:{s:14:"display_plugin";s:7:"default";s:2:"id";s:7:"default";s:13:"display_title";s:6:"Master";s:8:"position";i:0;s:15:"display_options";a:17:{s:6:"access";a:2:{s:4:"type";s:4:"perm";s:7:"options";a:1:{s:4:"perm";s:14:"access content";}}s:5:"cache";a:2:{s:4:"type";s:3:"tag";s:7:"options";a:0:{}}s:5:"query";a:2:{s:4:"type";s:11:"views_query";s:7:"options";a:5:{s:19:"disable_sql_rewrite";b:0;s:8:"distinct";b:0;s:7:"replica";b:0;s:13:"query_comment";s:0:"";s:10:"query_tags";a:0:{}}}s:12:"exposed_form";a:2:{s:4:"type";s:5:"basic";s:7:"options";a:7:{s:13:"submit_button";s:5:"Apply";s:12:"reset_button";b:0;s:18:"reset_button_label";s:5:"Reset";s:19:"exposed_sorts_label";s:7:"Sort by";s:17:"expose_sort_order";b:1;s:14:"sort_asc_label";s:3:"Asc";s:15:"sort_desc_label";s:4:"Desc";}}s:5:"pager";a:2:{s:4:"type";s:4:"mini";s:7:"options";a:6:{s:14:"items_per_page";i:10;s:6:"offset";i:0;s:2:"id";i:0;s:11:"total_pages";N;s:6:"expose";a:7:{s:14:"items_per_page";b:0;s:20:"items_per_page_label";s:14:"Items per page";s:22:"items_per_page_options";s:13:"5, 10, 25, 50";s:26:"items_per_page_options_all";b:0;s:32:"items_per_page_options_all_label";s:7:"- All -";s:6:"offset";b:0;s:12:"offset_label";s:6:"Offset";}s:4:"tags";a:2:{s:8:"previous";s:6:"‹‹";s:4:"next";s:6:"››";}}}s:5:"style";a:2:{s:4:"type";s:7:"default";s:7:"options";a:4:{s:8:"grouping";a:0:{}s:9:"row_class";s:0:"";s:17:"default_row_class";b:1;s:11:"uses_fields";b:0;}}s:3:"row";a:2:{s:4:"type";s:6:"fields";s:7:"options";a:4:{s:6:"inline";a:0:{}s:9:"separator";s:0:"";s:10:"hide_empty";b:0;s:22:"default_field_elements";b:1;}}s:6:"fields";a:1:{s:5:"title";a:37:{s:2:"id";s:5:"title";s:5:"table";s:15:"node_field_data";s:5:"field";s:5:"title";s:11:"entity_type";s:4:"node";s:12:"entity_field";s:5:"title";s:5:"label";s:0:"";s:5:"alter";a:8:{s:10:"alter_text";b:0;s:9:"make_link";b:0;s:8:"absolute";b:0;s:4:"trim";b:0;s:13:"word_boundary";b:0;s:8:"ellipsis";b:0;s:10:"strip_tags";b:0;s:4:"html";b:0;}s:10:"hide_empty";b:0;s:10:"empty_zero";b:0;s:8:"settings";a:1:{s:14:"link_to_entity";b:1;}s:9:"plugin_id";s:5:"field";s:12:"relationship";s:4:"none";s:10:"group_type";s:5:"group";s:11:"admin_label";s:0:"";s:7:"exclude";b:0;s:12:"element_type";s:0:"";s:13:"element_class";s:0:"";s:18:"element_label_type";s:0:"";s:19:"element_label_class";s:0:"";s:19:"element_label_colon";b:1;s:20:"element_wrapper_type";s:0:"";s:21:"element_wrapper_class";s:0:"";s:23:"element_default_classes";b:1;s:5:"empty";s:0:"";s:16:"hide_alter_empty";b:1;s:17:"click_sort_column";s:5:"value";s:4:"type";s:6:"string";s:12:"group_column";s:5:"value";s:13:"group_columns";a:0:{}s:10:"group_rows";b:1;s:11:"delta_limit";i:0;s:12:"delta_offset";i:0;s:14:"delta_reversed";b:0;s:16:"delta_first_last";b:0;s:10:"multi_type";s:9:"separator";s:9:"separator";s:2:", ";s:17:"field_api_classes";b:0;}}s:7:"filters";a:2:{s:17:"field_range_value";a:14:{s:2:"id";s:17:"field_range_value";s:5:"table";s:17:"node__field_range";s:5:"field";s:17:"field_range_value";s:12:"relationship";s:4:"none";s:10:"group_type";s:5:"group";s:11:"admin_label";s:0:"";s:8:"operator";s:1:"=";s:5:"value";s:4:"2017";s:5:"group";i:1;s:7:"exposed";b:0;s:6:"expose";a:10:{s:11:"operator_id";s:0:"";s:5:"label";s:0:"";s:11:"description";s:0:"";s:12:"use_operator";b:0;s:8:"operator";s:0:"";s:10:"identifier";s:0:"";s:8:"required";b:0;s:8:"remember";b:0;s:8:"multiple";b:0;s:14:"remember_roles";a:1:{s:13:"authenticated";s:13:"authenticated";}}s:10:"is_grouped";b:0;s:10:"group_info";a:10:{s:5:"label";s:0:"";s:11:"description";s:0:"";s:10:"identifier";s:0:"";s:8:"optional";b:1;s:6:"widget";s:6:"select";s:8:"multiple";b:0;s:8:"remember";b:0;s:13:"default_group";s:3:"All";s:22:"default_group_multiple";a:0:{}s:11:"group_items";a:0:{}}s:9:"plugin_id";s:6:"string";}s:21:"field_range_end_value";a:14:{s:2:"id";s:21:"field_range_end_value";s:5:"table";s:17:"node__field_range";s:5:"field";s:21:"field_range_end_value";s:12:"relationship";s:4:"none";s:10:"group_type";s:5:"group";s:11:"admin_label";s:0:"";s:8:"operator";s:8:"contains";s:5:"value";s:0:"";s:5:"group";i:1;s:7:"exposed";b:0;s:6:"expose";a:10:{s:11:"operator_id";s:0:"";s:5:"label";s:0:"";s:11:"description";s:0:"";s:12:"use_operator";b:0;s:8:"operator";s:0:"";s:10:"identifier";s:0:"";s:8:"required";b:0;s:8:"remember";b:0;s:8:"multiple";b:0;s:14:"remember_roles";a:1:{s:13:"authenticated";s:13:"authenticated";}}s:10:"is_grouped";b:0;s:10:"group_info";a:10:{s:5:"label";s:0:"";s:11:"description";s:0:"";s:10:"identifier";s:0:"";s:8:"optional";b:1;s:6:"widget";s:6:"select";s:8:"multiple";b:0;s:8:"remember";b:0;s:13:"default_group";s:3:"All";s:22:"default_group_multiple";a:0:{}s:11:"group_items";a:0:{}}s:9:"plugin_id";s:6:"string";}}s:5:"sorts";a:1:{s:17:"field_range_value";a:10:{s:2:"id";s:17:"field_range_value";s:5:"table";s:17:"node__field_range";s:5:"field";s:17:"field_range_value";s:12:"relationship";s:4:"none";s:10:"group_type";s:5:"group";s:11:"admin_label";s:0:"";s:5:"order";s:3:"ASC";s:7:"exposed";b:0;s:6:"expose";a:1:{s:5:"label";s:0:"";}s:9:"plugin_id";s:8:"standard";}}s:6:"header";a:0:{}s:6:"footer";a:0:{}s:5:"empty";a:0:{}s:13:"relationships";a:0:{}s:9:"arguments";a:0:{}s:17:"display_extenders";a:0:{}s:13:"filter_groups";a:2:{s:8:"operator";s:3:"AND";s:6:"groups";a:0:{}}}s:14:"cache_metadata";a:3:{s:7:"max-age";i:-1;s:8:"contexts";a:5:{i:0;s:26:"languages:language_content";i:1;s:28:"languages:language_interface";i:2;s:14:"url.query_args";i:3;s:21:"user.node_grants:view";i:4;s:16:"user.permissions";}s:4:"tags";a:0:{}}}}}',
))
->execute();

// Update core.extension.
$extensions = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute()
  ->fetchField();
$extensions = unserialize($extensions);
$extensions['module']['datetime_range'] = 0;
$connection->update('config')
  ->fields([
    'data' => serialize($extensions),
  ])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute();

$connection->insert('key_value')
->fields(array(
  'collection',
  'name',
  'value',
))
->values(array(
  'collection' => 'config.entity.key_store.field_config',
  'name' => 'uuid:87dc4221-8d56-4112-8a7f-7a855ac35d08',
  'value' => 'a:1:{i:0;s:33:"field.field.node.page.field_range";}',
))
->values(array(
  'collection' => 'config.entity.key_store.field_storage_config',
  'name' => 'uuid:2190ad8c-39dd-4eb1-b189-1bfc0c244a40',
  'value' => 'a:1:{i:0;s:30:"field.storage.node.field_range";}',
))
->values(array(
  'collection' => 'config.entity.key_store.view',
  'name' => 'uuid:d20760b6-7cc4-4844-ae04-96da7225a46f',
  'value' => 'a:1:{i:0;s:44:"views.view.test_datetime_range_filter_values";}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'node.field_schema_data.field_range',
  'value' => 'a:2:{s:17:"node__field_range";a:4:{s:11:"description";s:40:"Data storage for node field field_range.";s:6:"fields";a:8:{s:6:"bundle";a:5:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:8:"not null";b:1;s:7:"default";s:0:"";s:11:"description";s:88:"The field instance bundle to which this row belongs, used when deleting a field instance";}s:7:"deleted";a:5:{s:4:"type";s:3:"int";s:4:"size";s:4:"tiny";s:8:"not null";b:1;s:7:"default";i:0;s:11:"description";s:60:"A boolean indicating whether this data item has been deleted";}s:9:"entity_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;s:11:"description";s:38:"The entity id this data is attached to";}s:11:"revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;s:11:"description";s:47:"The entity revision id this data is attached to";}s:8:"langcode";a:5:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:32;s:8:"not null";b:1;s:7:"default";s:0:"";s:11:"description";s:37:"The language code for this data item.";}s:5:"delta";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;s:11:"description";s:67:"The sequence number for this data item, used for multi-value fields";}s:17:"field_range_value";a:4:{s:11:"description";s:21:"The start date value.";s:4:"type";s:7:"varchar";s:6:"length";i:20;s:8:"not null";b:1;}s:21:"field_range_end_value";a:4:{s:11:"description";s:19:"The end date value.";s:4:"type";s:7:"varchar";s:6:"length";i:20;s:8:"not null";b:1;}}s:11:"primary key";a:4:{i:0;s:9:"entity_id";i:1;s:7:"deleted";i:2;s:5:"delta";i:3;s:8:"langcode";}s:7:"indexes";a:4:{s:6:"bundle";a:1:{i:0;s:6:"bundle";}s:11:"revision_id";a:1:{i:0;s:11:"revision_id";}s:17:"field_range_value";a:1:{i:0;s:17:"field_range_value";}s:21:"field_range_end_value";a:1:{i:0;s:21:"field_range_end_value";}}}s:26:"node_revision__field_range";a:4:{s:11:"description";s:52:"Revision archive storage for node field field_range.";s:6:"fields";a:8:{s:6:"bundle";a:5:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:8:"not null";b:1;s:7:"default";s:0:"";s:11:"description";s:88:"The field instance bundle to which this row belongs, used when deleting a field instance";}s:7:"deleted";a:5:{s:4:"type";s:3:"int";s:4:"size";s:4:"tiny";s:8:"not null";b:1;s:7:"default";i:0;s:11:"description";s:60:"A boolean indicating whether this data item has been deleted";}s:9:"entity_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;s:11:"description";s:38:"The entity id this data is attached to";}s:11:"revision_id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;s:11:"description";s:47:"The entity revision id this data is attached to";}s:8:"langcode";a:5:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:32;s:8:"not null";b:1;s:7:"default";s:0:"";s:11:"description";s:37:"The language code for this data item.";}s:5:"delta";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:1;s:11:"description";s:67:"The sequence number for this data item, used for multi-value fields";}s:17:"field_range_value";a:4:{s:11:"description";s:21:"The start date value.";s:4:"type";s:7:"varchar";s:6:"length";i:20;s:8:"not null";b:1;}s:21:"field_range_end_value";a:4:{s:11:"description";s:19:"The end date value.";s:4:"type";s:7:"varchar";s:6:"length";i:20;s:8:"not null";b:1;}}s:11:"primary key";a:5:{i:0;s:9:"entity_id";i:1;s:11:"revision_id";i:2;s:7:"deleted";i:3;s:5:"delta";i:4;s:8:"langcode";}s:7:"indexes";a:4:{s:6:"bundle";a:1:{i:0;s:6:"bundle";}s:11:"revision_id";a:1:{i:0;s:11:"revision_id";}s:17:"field_range_value";a:1:{i:0;s:17:"field_range_value";}s:21:"field_range_end_value";a:1:{i:0;s:21:"field_range_end_value";}}}}',
))
->values(array(
  'collection' => 'system.schema',
  'name' => 'datetime_range',
  'value' => 'i:8000;',
))
->execute();

// Update entity.definitions.bundle_field_map
$value = $connection->select('key_value')
  ->fields('key_value', ['value'])
  ->condition('collection', 'entity.definitions.bundle_field_map')
  ->condition('name', 'node')
  ->execute()
  ->fetchField();

$value = unserialize($value);
$value["field_range"] = array("type" => "daterange", "bundles" => array("page" => "page"));

$connection->update('key_value')
  ->fields([
    'value' => serialize($value),
  ])
  ->condition('collection', 'entity.definitions.bundle_field_map')
  ->condition('name', 'node')
  ->execute();

// Update system.module.files
$files = $connection->select('key_value')
  ->fields('key_value', ['value'])
  ->condition('collection', 'state')
  ->condition('name', 'system.module.files')
  ->execute()
  ->fetchField();

$files = unserialize($files);
$files["datetime_range"] = "core/modules/datetime_range/datetime_range.info.yml";

$connection->update('key_value')
  ->fields([
    'value' => serialize($files),
  ])
  ->condition('collection', 'state')
  ->condition('name', 'system.module.files')
  ->execute();

$connection->schema()->createTable('node__field_range', array(
  'fields' => array(
    'bundle' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '128',
      'default' => '',
    ),
    'deleted' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'tiny',
      'default' => '0',
    ),
    'entity_id' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'revision_id' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'langcode' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '32',
      'default' => '',
    ),
    'delta' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'field_range_value' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '20',
    ),
    'field_range_end_value' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '20',
    ),
  ),
  'primary key' => array(
    'entity_id',
    'deleted',
    'delta',
    'langcode',
  ),
  'indexes' => array(
    'bundle' => array(
      'bundle',
    ),
    'revision_id' => array(
      'revision_id',
    ),
    'field_range_value' => array(
      'field_range_value',
    ),
    'field_range_end_value' => array(
      'field_range_end_value',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));

$connection->schema()->createTable('node_revision__field_range', array(
  'fields' => array(
    'bundle' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '128',
      'default' => '',
    ),
    'deleted' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'tiny',
      'default' => '0',
    ),
    'entity_id' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'revision_id' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'langcode' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '32',
      'default' => '',
    ),
    'delta' => array(
      'type' => 'int',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'field_range_value' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '20',
    ),
    'field_range_end_value' => array(
      'type' => 'varchar',
      'not null' => TRUE,
      'length' => '20',
    ),
  ),
  'primary key' => array(
    'entity_id',
    'revision_id',
    'deleted',
    'delta',
    'langcode',
  ),
  'indexes' => array(
    'bundle' => array(
      'bundle',
    ),
    'revision_id' => array(
      'revision_id',
    ),
    'field_range_value' => array(
      'field_range_value',
    ),
    'field_range_end_value' => array(
      'field_range_end_value',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));

