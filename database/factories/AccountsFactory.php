<?php

namespace Database\Factories;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accounts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "first_name" => "Bengkel mobil sangkut",
            "last_name" => "Kota Lubuklinggau",
            "description" => "Bengkel Mobil sangkut kini sudah menjadi bengkel mobil terbaik dikota lubuklinggau, untuk melayani anda ahli dalam memeliharaan untuk ban, layanan memeliharaan rem, baterai, shock, absorber, suspensi mobil, sistem pendingin udara, dan penggantian oli, dan kami menawarkan penuh dari mekanik terlatih dan proffesional yang merupakan spesialis di bidang masing - masing, mekanik kami siap memberikan anda saran, memberikan layanan terbaik dan dibengkel sangkut siap untuk melayan perbaikan kendaraan anda diluar lokasi kota lubuklinggau, dan kami akan mengirimkan mekanik yang handal untuk memperbaiki kendaraan anda.",
            "logo" => "http://localhost:8000/images/Tanpa judul (5).png",
            "user_id" => User::first()->id
        ];
    }
}
