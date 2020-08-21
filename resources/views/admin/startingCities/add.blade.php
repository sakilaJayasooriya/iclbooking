@php 
$form_data = [
    'page_title'=> 'Add Staritng City',
    'page_subtitle'=> '', 
    'form_name' => 'Add Staritng City Form',
    'form_id' => 'add_city',
    'action' => URL::to('/').'/admin/settings/add-starting-cities',
    'form_type' => 'file',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => ' Staring City Name', 'name' => 'name', 'value' => ''],
      ['type' => 'textarea', 'class' => '', 'label' => ' City Description', 'name' => 'c_description', 'value' => ''],
      ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' => ''],

      ['type' => 'text', 'class' => '', 'label' => ' Weather', 'name' => 'weather', 'value' => ''],
      ['type' => 'text', 'class' => '', 'label' => ' Population', 'name' => 'population', 'value' => ''],
      ['type' => 'text', 'class' => '', 'label' => ' Mayor', 'name' => 'mayor', 'value' => ''],
      ['type' => 'text', 'class' => '', 'label' => ' Municipality', 'name' => 'municipality', 'value' => ''],

      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],


    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#add_city').validate({
                rules: {
                    name: {
                        required: true
                    },
                    image: {
                        required: true,
                        //extension: "jpg|png|jpeg"
                        accept: "image/jpg,image/jpeg,image/png"
                        //accept: "image/*"
                    }
                },
                messages: {
                    image: {
                        accept: 'The file must be an image (jpg, jpeg or png)'
                    }
                }  
            });

        });
</script>