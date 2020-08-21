@php 
$form_data = [
    'page_title'=> 'Edit Destinations City',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Destinations Form',
    'form_id' => 'edit_top_destinations',     
    'action' => URL::to('/').'/admin/settings/edit-top-destinations/'.@$result->id,
    'form_type' => 'file',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => ' Destination Name', 'name' => 'title', 'value' => $result->title],
      ['type' => 'textarea', 'class' => '', 'label' => ' Description', 'name' => 'description', 'value' => $result->descripion],
      ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' =>'','image' => url('public/front/images/top_destinations/'.$result['image'])],
    
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],


    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_top_destinations').validate({
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