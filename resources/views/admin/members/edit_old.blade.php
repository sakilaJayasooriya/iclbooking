@php 

$form_data = [
		'page_title'=> 'Profile Edit Form',
		'page_subtitle'=> 'Edit your profile', 
		'form_name' => 'Profile Edit Form',
		'action' => URL::to('/').'/admin/edit_member/'.$result->id,
		'fields' => [
			['type' => 'text', 'class' => 'validate_field', 'label' => 'Name', 'name' => 'name', 'value' => @$result->name],
      		['type' => 'text', 'class' => 'validate_field', 'label' => 'Email', 'name' => 'email', 'value' => @$result->email],
      		['type' => 'select', 'options' => $country_ar, 'class' => 'validate_field', 'label' => 'Country', 'name' => 'country', 'value' => @$result->country_id],
			['type' => 'select', 'options' => ['User' => 'User', 'Admin' => 'Admin'], 'class' => 'validate_field', 'label' => 'Type', 'name' => 'type'],
			['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => @$result->status],
		]
	];
@endphp
@include("admin.common.form.primary", $form_data)