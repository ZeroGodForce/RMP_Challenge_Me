<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('CoursesTableSeeder');
        $this->command->info('Courses table seeded!');
        
        $this->call('StudentsTableSeeder');
        $this->command->info('Students table seeded!');
        
        $this->call('StudentsAddressTableSeeder');
        $this->command->info('StudentsAddress table seeded!');
    }

}
