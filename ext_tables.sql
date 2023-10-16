CREATE TABLE tx_mailjetapi_domain_model_subscription (
    contact_id int(10) unsigned NOT NULL DEFAULT 0,
    email varchar(255) NOT NULL DEFAULT '',
    receiver_name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_mailjetapi_domain_model_property (
    form_property_name varchar(255) NOT NULL DEFAULT '',
    mailjet_property_name varchar(255) NOT NULL DEFAULT '',
    form_property_type varchar(255) NOT NULL DEFAULT '',
    form_property_placeholder varchar(255) NOT NULL DEFAULT '',
    form_property_required smallint unsigned DEFAULT '0' NOT NULL,
    use_for_mailjet_name smallint unsigned DEFAULT '0' NOT NULL,
    use_for_mailjet_email smallint unsigned DEFAULT '0' NOT NULL
);
