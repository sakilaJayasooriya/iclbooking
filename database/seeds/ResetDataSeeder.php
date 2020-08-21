<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoleAdmin;
use App\Models\PermissionRole;
class ResetDataSeeder extends Seeder
{

    public function run()
    {
        DB::table('admin')->truncate();
        DB::table('accounts')->truncate();
        DB::table('bookings')->truncate();
        DB::table('booking_details')->truncate();
        DB::table('messages')->truncate();
        DB::table('payouts')->truncate();
        DB::table('payout_penalties')->truncate();
        DB::table('penalty')->truncate();
        DB::table('properties')->truncate();
        DB::table('property_address')->truncate();
        DB::table('property_beds')->truncate();
        DB::table('property_dates')->truncate();
        DB::table('property_description')->truncate();
        DB::table('property_details')->truncate();
        DB::table('property_fees')->truncate();
        DB::table('property_photos')->truncate();
        DB::table('property_price')->truncate();
        DB::table('property_rules')->truncate();
        DB::table('property_steps')->truncate();
        DB::table('users')->truncate();
        DB::table('users_verification')->truncate();
        DB::table('user_details')->truncate();


        $this->call(AmenityTypeTableSeeder::class);
        $this->call(AmenitiesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(BedTypeTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(MessageTypeTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        //$this->call(PaymentMethodsTableSeeder::class);
        //$this->call(PermissionsTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        //$this->call(RulesTableSeeder::class);
        $this->call(SeoMetasTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(StartingCitiesTableSeeder::class);
        $this->call(PropertyFeesTableSeeder::class);
        $this->call(SpaceTypeTableSeeder::class);
        //$this->call(TimezoneTableSeeder::class);


        DB::table('admin')->insert(['username' => 'admin', 'email' => 'admin@techvill.net', 'password' => Hash::make('123456'), 'status' => 'Active', 'created_at' => date('Y-m-d H:i:s')] );
        
        $role_user           = new RoleAdmin;
        $role_user->truncate();
        $role_user->admin_id = 1;
        $role_user->role_id  = '1';
        $role_user->save();

        $data = [
                    ['permission_id' => 1, 'role_id' => '1'],
                    ['permission_id' => 2, 'role_id' => '1'],
                    ['permission_id' => 3, 'role_id' => '1'],
                    ['permission_id' => 4, 'role_id' => '1'],
                    ['permission_id' => 5, 'role_id' => '1'],
                    ['permission_id' => 6, 'role_id' => '1'],
                    ['permission_id' => 7, 'role_id' => '1'],
                    ['permission_id' => 8, 'role_id' => '1'],
                    ['permission_id' => 9, 'role_id' => '1'],
                    ['permission_id' => 10, 'role_id' => '1'],
                    ['permission_id' => 11, 'role_id' => '1'],
                    ['permission_id' => 12, 'role_id' => '1'],
                    ['permission_id' => 13, 'role_id' => '1'],
                    ['permission_id' => 14, 'role_id' => '1'],
                    ['permission_id' => 15, 'role_id' => '1'],
                    ['permission_id' => 16, 'role_id' => '1'],
                    ['permission_id' => 17, 'role_id' => '1'],
                    ['permission_id' => 18, 'role_id' => '1'],
                    ['permission_id' => 19, 'role_id' => '1'],
                    ['permission_id' => 20, 'role_id' => '1'],
                    ['permission_id' => 21, 'role_id' => '1'],
                    ['permission_id' => 22, 'role_id' => '1'],
                    ['permission_id' => 23, 'role_id' => '1'],
                    ['permission_id' => 24, 'role_id' => '1'],
                    ['permission_id' => 25, 'role_id' => '1'],
                    ['permission_id' => 26, 'role_id' => '1'],
                    ['permission_id' => 27, 'role_id' => '1'],
                    ['permission_id' => 28, 'role_id' => '1'],
                    ['permission_id' => 29, 'role_id' => '1'],
                    ['permission_id' => 30, 'role_id' => '1'],
                    ['permission_id' => 31, 'role_id' => '1'],
                    ['permission_id' => 32, 'role_id' => '1'],
                    ['permission_id' => 33, 'role_id' => '1'],
                    ['permission_id' => 34, 'role_id' => '1'],
                ];
        PermissionRole::truncate();
        PermissionRole::insert($data);

        User::insert( ['first_name' => 'test', 'last_name' => 'user', 'email' => 'test@techvill.net', 'password' => Hash::make('123456'), 'status' => 'Active', 'created_at' => date('Y-m-d H:i:s')] );
        User::insert( ['first_name' => 'customer', 'last_name' => 'user', 'email' => 'customer@techvill.net', 'password' => Hash::make('123456'), 'status' => 'Active', 'created_at' => date('Y-m-d H:i:s')] );
        
        DB::table('users_verification')->insert(['user_id' => 1, 'email' => 'yes']);
        DB::table('users_verification')->insert(['user_id' => 2, 'email' => 'yes']);
        
        DB::table('properties')->insert([
            ['name' => 'Hampton Inn', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 10, 'beds' => 10, 'bed_type' => 1, 'bathrooms' => 8.00, 'amenities' => '1,2,4,5,7,9,10,29,30,31', 'property_type' => 1, 'space_type' => 1, 'accommodates' => 16, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed'],
            ['name' => 'North Sydney Harbourview Hotel', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 10, 'beds' => 15, 'bed_type' => 2, 'bathrooms' => 8.00, 'amenities' => '1,3,4,5,6,7,8,9,10,27,28', 'property_type' => 2, 'space_type' => 2, 'accommodates' => 15, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed'],
            ['name' => 'Hotel Paris Rivoli', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 10, 'beds' => 16, 'bed_type' => 3, 'bathrooms' => 8.00, 'amenities' => '1,2,4,5,6,11,12,13,14,17,18,19,21', 'property_type' => 3, 'space_type' => 3, 'accommodates' => 10, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed'],
            ['name' => 'K+K Picasso', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 10, 'beds' => 10, 'bed_type' => 4, 'bathrooms' => 8.00, 'amenities' => '1,3,4,5,6,7,10,11,21,22,23,24,25,26,27,28,29', 'property_type' => 5, 'space_type' => 1, 'accommodates' => 10, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed'],
            ['name' => 'CONTACT APEX HOTELS', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 5, 'beds' => 10, 'bed_type' => 6, 'bathrooms' => 8.00, 'amenities' => '1,3,4,9,10,11,17,18,19,20,21', 'property_type' => 6, 'space_type' => 2, 'accommodates' => 10, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed'],
            ['name' => 'City Center Inn & Suites', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 5, 'beds' => 8, 'bed_type' => 7, 'bathrooms' => 3.00, 'amenities' => '17,18,19,20,23,24,29', 'property_type' => 7, 'space_type' => 3, 'accommodates' => 8, 'booking_type' => 'instant', 'cancellation' => 'Flexible', 'status' => 'Listed']
 
        ]);

        DB::table('property_address')->insert([
            [ 'property_id' => 1, 'address_line_1' => 'New York City Hall, New York, NY 10007, USA', 'address_line_2' => '851 8th Ave, New York, NY, US, 10019', 'latitude' => '40.7127461', 'longitude' => '-74.00597399999998', 'city' => 'New York', 'state' => 'New York', 'country' => 'US', 'postal_code' => '10007'],
            [ 'property_id' => 2, 'address_line_1' => 'MLC Centre, 108 King St, Sydney NSW 2000, Australia', 'address_line_2' => NULL, 'latitude' => '-33.8686949', 'longitude' => '151.2092424', 'city' => 'Sydney', 'state' => 'New South Wales', 'country' => 'AU', 'postal_code' => '2000'],
            [ 'property_id' => 3, 'address_line_1' => '19 Rue de Rivoli, 75004 Paris, France', 'address_line_2' => NULL, 'latitude' => '48.8559431', 'longitude' => '2.3573452000000543', 'city' => 'Paris', 'state' => 'Île-de-France', 'country' => 'FR', 'postal_code' => '75004'],
            [ 'property_id' => 4, 'address_line_1' => 'Passeig de Picasso, 26, 08003 Barcelona, Spain', 'address_line_2' => NULL, 'latitude' => '41.3866227', 'longitude' => '2.184072199999946', 'city' => 'Barcelona', 'state' => 'Catalunya', 'country' => 'ES', 'postal_code' => '08003'],
            [ 'property_id' => 5, 'address_line_1' => '12 Stacey St, London WC2H, UK', 'address_line_2' => NULL, 'latitude' => '51.5142805', 'longitude' => '-0.12846539999998186', 'city' => 'London', 'state' => 'England', 'country' => 'GB', 'postal_code' => 'WC2H'],
            [ 'property_id' => 6, 'address_line_1' => '240 7th St, San Francisco, CA 94103, USA', 'address_line_2' => NULL, 'latitude' => '37.7771788', 'longitude' => '-122.40894029999998', 'city' => 'SF', 'state' => 'California', 'country' => 'US', 'postal_code' => '94103']
        ]);

        DB::table('property_description')->insert([
            ['property_id' => 1, 'summary' => 'A stay at Hampton Inn Times Square North places you in the heart of New York, walking distance from Studio 54 and Ed Sullivan Theater. This hotel is close to Broadway and Rockefeller Center.'],
            ['property_id' => 2, 'summary' => 'The View Hotels comprise three hotels within Australia located in three of the most beautiful and exciting cities – Sydney, Melbourne and Brisbane.'],
            ['property_id' => 3, 'summary' => 'Situated in the famous Marais district surrounded by boutiques, monuments and museums, the Hotel Paris Rivoli offers three-star accommodations in the most desirable part of Paris.'],
            ['property_id' => 4, 'summary' => 'K+K Picasso offers 4-star elegance in Barcelona’s El Born district, directly opposite Parc de la Ciutadella and Barcelona Zoo on Passeig de Picasso. The hotel has avant-garde architecture, a rooftop pool with city views and is less than 15 minutes’ walk from La Rambla, Barceloneta Beach and the Gothic Quarter.'],
            ['property_id' => 5, 'summary' => 'CONTACT APEX HOTELS'],
            ['property_id' => 6, 'summary' => 'Set in the SoMA neighborhood, this straightforward hotel with an annex is 1 mile from Union Square\'s shopping, 1.5 miles from Chinatown and 2.5 miles from Fisherman\'s Wharf\'s seafood restaurants.'],
        ]);

        DB::table('property_photos')->insert([
            ['property_id' => 1, 'photo' => '1504070163_1503140414_Hampton-Inn-and-Suites-Sweetwater---exterior.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 1, 'photo' => '1504070163_1503140449_bg5.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 1, 'photo' => '1504070163_1503140449_Hampton-Inn-and-Suites---Buda.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 1, 'photo' => '1504070163_1503140449_hampton-inn-suites_42.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 2, 'photo' => '1504070868_harbourview-hotel-north-sydney-outside-pic.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 2, 'photo' => '1504070868_image.adapt.985.HIGH.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 2, 'photo' => '1504070868_North-Sydney-Harbourview-Hotel96.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 3, 'photo' => '1504071313_4769_Hotel_Paris_Rivoli.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 3, 'photo' => '1504071313_65177_140_z.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 3, 'photo' => '1504071313_563271.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 3, 'photo' => '1504071313_579011.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => '1504072520_1560-9e515ef868aa7e289b92acfac1fd06b6.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 4, 'photo' => '1504072607_10029755.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 6, 'photo' => '1504072925_36e10bae_z.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 5, 'photo' => '1504072520_1599-13b29ff614e28c9695e9bf796507822f.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => '1504072520_2165-80ac4d369f9385a2d3fe99ae3205c6df.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => '1504072520_Apex-Hotels-Voucher-Code.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => '1504072520_DSC_1029.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 4, 'photo' => '1504072607_k-k-hotel-picasso.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 4, 'photo' => '1504072607_k-k-picasso-standard-room-2-.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 6, 'photo' => '1504072925_agoda-64452-64452_15090417590035627715.jpg_s=312x-image.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 6, 'photo' => '1504072925_hotel-city-center-inn-suites-san-francisco-002.jpg', 'message' => NULL, 'cover_photo' => 0]
        ]);

        DB::table('property_price')->insert([
            ['property_id' => 1, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 5, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 2, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 6, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 3, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 7, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 4, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 8, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 5, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 20, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 6, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 120, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD']
        ]);

        DB::table('property_steps')->insert([
            ['property_id' => 1, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 2, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 3, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 4, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 5, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 6, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1]
        ]);

        /*DB::table('settings')->where('name', 'head_code')
       ->update(['value' => "<script>
                  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                  ga('create', 'UA-85305348-1', 'auto');
                  ga('send', 'pageview');
                </script>"]);*/
    }
}
