<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::create(['name' => 'Argumented Reality']);

        $superAdmin = UserType::create([
            'name' =>'super-admin'
        ]);

        $admin =  UserType::create([
            'name' =>'admin'
        ]);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'Brian',
            'last_name' => 'Thomas',
            'email' => 'testdev.coder@gmail.com',
            'password' => 'testdev.coder@gmail.com',
            'owner' => true,
            'user_type_id' => $superAdmin->id
        ]);

        User::factory(5)->create(['account_id' => $account->id , 'user_type_id' => $admin->id]);

        $organizations = Organization::factory(100)
            ->create(['account_id' => $account->id]);

        Contact::factory(100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });
    }
}
