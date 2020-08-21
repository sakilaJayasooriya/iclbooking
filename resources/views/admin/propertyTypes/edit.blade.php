@php 
$form_data = [
    'page_title'=> 'Edit Property Type',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Property Type Form',
    'form_id' => 'edit_property',
    'action' => URL::to('/').'/admin/settings/edit-property-type/'.$result->id,
    'form_type' => 'file',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => $result->name],
      ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description', 'value' => $result->description],
      ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' =>'','image' => url('public/front/images/property_type/'.$result['image'])],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => @$result->status],

    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_property').validate({
                rules: {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    image: {
                        required: false, //changed this to false from true.because without img should can update
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