@php 
$form_data = [
    'page_title'=> 'Add Destination',
    'page_subtitle'=> '', 
    'form_name' => 'Add Destination Form',
    'form_id' => 'add_destination',
    'action' => URL::to('/').'/admin/settings/add-top-destinations',
    'form_type' => 'file',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => ' Destination Title', 'name' => 'title', 'value' => ''],
      ['type' => 'textarea', 'class' => '', 'label' => ' Description', 'name' => 'description', 'value' => ''],
      ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' => ''],

      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],


    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#add_destination').validate({
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