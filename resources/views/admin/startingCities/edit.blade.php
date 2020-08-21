@php 
$form_data = [
    'page_title'=> 'Edit Staritng City',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Staritng City Form',
    'form_id' => 'edit_staritng_city',     
    'action' => URL::to('/').'/admin/settings/edit-starting-cities/'.@$result->id,
    'form_type' => 'file',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => ' Staring City Name', 'name' => 'name', 'value' => $result->name],
      ['type' => 'textarea', 'class' => '', 'label' => ' City Description', 'name' => 'c_description', 'value' => $result->description_city],
      ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' =>'','image' => url('public/front/images/starting_cities/'.$result['image'])],
      
      ['type' => 'text', 'class' => '', 'label' => ' Weather', 'name' => 'weather', 'value' => $result->weather],
      ['type' => 'text', 'class' => '', 'label' => ' Population', 'name' => 'population', 'value' => $result->population],
      ['type' => 'text', 'class' => '', 'label' => ' Mayor', 'name' => 'mayor', 'value' => $result->mayor],
      ['type' => 'text', 'class' => '', 'label' => ' Municipality', 'name' => 'municipality', 'value' => $result->municipality],

      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],


    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_staritng_city').validate({
                rules: {
                    name: {
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