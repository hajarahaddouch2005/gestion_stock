<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Stock;
use App\Models\User;
use Dom\RandomError;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = [
            Order::class,
            Stock::class
        ];

        $t = fake()->randomElement($type);
        $model = $t::factory()->create();
        return [
            //
            'user_id'=>User::factory(),
            'transactionable_type'=>$t,
            'transactionable_id'=>$model->id,
            'operation'=>fake()->randomElement(['created', 'updated', 'deleted'])
        ];
    }
}
