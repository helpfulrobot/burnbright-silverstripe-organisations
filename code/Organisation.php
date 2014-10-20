<?php

class Organisation extends DataObject{
	
	private static $db = array(
		'Name' => 'Varchar',
		//address
		//contact details
	);

	private static $has_one = array(
		'Logo' => 'Image'
	);

	private static $has_many = array(
		'Members' => 'Member'
	);

	private static $default_sort = 'Name ASC';

	public function getOrganisationFormFields(){
		$fields = new FieldList(
			TextField::create("Name", $this->i18n_singular_name()." Name")
		);

		$this->extend('updateOrganisationFormFields', $fields);
		return $fields;
	}

	public function getTitle(){
		return $this->Name;
	}

	public function getProfileLink() {
		if($directory = OrganisationDirectoryPage::get()->first()){
			return Controller::join_links(
				$directory->Link(),
				'view',
				$this->ID
			);
		}
	}

}