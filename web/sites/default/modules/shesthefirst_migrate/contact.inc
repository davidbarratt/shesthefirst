<?php

class ShesTheFirstContactMigration extends DynamicMigration {

  public function __construct() {
    parent::__construct();

    // Set the Team Member.
    $this->team = array(
      new MigrateTeamMember('David Barratt', 'david@davidwbarratt.com', t('Implementor')),
    );

    // Set the Description
    $this->description = t('Migrate contacts from existing database');

    $source_key = array(
      'facebook_id' => array(
        'type' => 'int',
        'size' => 'big',
        'not null' => TRUE,
        'description' => 'Facebook ID',
      ),
    );

    // Set up our destination - Invididual CRM Contacts.
    $this->destination = new MigrateDestinationCRMCoreContact('individual');

    // Create a Map Object to Map the Relationships
    $this->map = new MigrateSQLMap($this->machineName, $source_key, $this->destination->getKeySchema());

    // Create the Query
    $query = Database::getConnection('default', 'legacy')->select('facebook', 'f');

    $fields = array(
      'facebook_id',
      'username',
      'first_name',
      'last_name',
      'email',
      'created',
      'updated',
      'access_token',
    );

    $query->fields('f', $fields);

    // Create a MigrateSource object, which manages retrieving the input data.
    $this->source = new MigrateSourceSQL($query);

    // Create the Field Mappings.
    $this->addSimpleMappings(array('created'));
    $this->addFieldMapping('field_email', 'email');
    $this->addFieldMapping('changed', 'updated');
    $this->addFieldMapping('contact_name:given', 'first_name');
    $this->addFieldMapping('contact_name:family', 'last_name');

    // Set Default UID
    $this->addFieldMapping('uid')->defaultValue(0);
    $this->addFieldMapping('field_address:country')->defaultValue('US');

    // Unmapped Source Fields.
    $this->addFieldMapping(NULL, 'username');
    $this->addFieldMapping(NULL, 'access_token');

    // Unmapped Destination Fields
    $this->addUnmigratedDestinations(array(
      'contact_name',
      'field_phone',
      'field_address',
      'field_address:administrative_area',
      'field_address:sub_administrative_area',
      'field_address:locality',
      'field_address:dependent_locality',
      'field_address:postal_code',
      'field_address:thoroughfare',
      'field_address:premise',
      'field_address:sub_premise',
      'field_address:organisation_name',
      'field_address:name_line',
      'field_address:first_name',
      'field_address:last_name',
      'field_address:data',
      'field_class_year',
      'field_class_year:timezone',
      'field_class_year:rrule',
      'field_class_year:to',
    ));

  }

  public function prepare(stdClass $contact, stdClass $row) {

    // Put the dates into the proper, Drupal format.
    $contact->created = strtotime($contact->created);
    $contact->changed = strtotime($contact->changed);

  }

}
