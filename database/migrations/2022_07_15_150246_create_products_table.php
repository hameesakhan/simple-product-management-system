<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->required()->unique();
            $table->foreignIdFor(Category::class);
            $table->decimal('rate', 10, 2)->nullable();
            $table->unsignedBigInteger('quantity')->required()->default(0);
            $table->unsignedBigInteger('barcode_identifier')->nullable()->default(null);

            $table->foreignIdFor(Vendor::class);
            $table->foreignIdFor(User::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
