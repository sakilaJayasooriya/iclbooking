@php 
$form_data = [
		'page_title'=> 'Fees Setting Form',
		'page_subtitle'=> 'Fees Setting Page', 
		'form_name' => 'Fees Setting Form',
		'form_id' => 'fees_setting',
		'action' => URL::to('/').'/admin/settings/fees',
		'fields' => [
			
      		['type' => 'text', 'class' => '', 'label' => 'Guest service charge (%)', 'name' => "guest_service_charge", 'value' => @$result['guest_service_charge'], 'hint' => 'service charge of guest for booking'],
		]
	];
@endphp
@include("admin.common.form.setting", $form_data)

{{--When need cancelation fees->uncooment these lines and add to fields-> 
    ['type' => 'text', 'class' => '', 'label' => 'Cancelation fees before seven days', 'name' => 'more_then_seven', 'value' => @$result['more_then_seven'], 'hint' => 'If host cancel booking more then 7 day before arrival this fee will apply.'],
    ['type' => 'text', 'class' => '', 'label' => 'Cancelation fees after seven days', 'name' => "less_then_seven", 'value' => @$result['less_then_seven'], 'hint' => 'If host cancel booking less then 7 day before arrival this fee will apply.'], --}}

<script type="text/javascript">
   $(document).ready(function () {

            $('#fees_setting').validate({
                rules: {
                    // more_then_seven: {
                    //     required: true
                    // },
                    // less_then_seven: {
                    //     required: true
                    // },
                    guest_service_charge: {
                        required: true
                    }
                }
            });

        });
</script>