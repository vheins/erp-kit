<?php

use App\Models\LocationProvince;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Rap2hpoutre\FastExcel\FastExcel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('country_id')->nullable()->constrained('location_countries');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('created_at')->nullable();
            $table->foreignUuid('created_by')->nullable()->contrained('users');
            $table->integer('updated_at')->nullable();
            $table->foreignUuid('updated_by')->nullable()->contrained('users');
            $table->integer('deleted_at')->nullable();
            $table->foreignUuid('deleted_by')->nullable()->contrained('users');
        });

        //Insert Data
        $path = database_path('csv/provinces.csv');
        $data = (new FastExcel())->import($path);
        $data->map(function (array $row) {
            return Arr::only($row, ["id", "name", "latitude", "longitude"]);
        })->chunk(1000)->each(function (Collection $chunk) {
            LocationProvince::upsert(
                json_decode(json_encode($chunk), true),
                ['id'],
                [
                    'created_at' => now()->timestamp,
                    'updated_at' => now()->timestamp,
                ]
            );
        });

        Artisan::call('make:permission', [
            'name' => 'location.province'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_provinces');
    }
};