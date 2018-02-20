<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UsersSeeder::class);   
        $this->call(BannersTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(MessageTableSeeder::class);
        $this->call(MethodPatmentsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(BranchOfficesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(FavoritiesSeeder::class);
        $this->call(VisitsSeeder::class);
        $this->call(RecommendationsSeeder::class);
        $this->call(ScoresSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(ToursSeeder::class);
        $this->call(ToursReservationsSeeder::class);
    }
}
