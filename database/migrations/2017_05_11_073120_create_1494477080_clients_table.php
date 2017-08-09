<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1494477080ClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
				$table->string('city');
				$table->string('state');
				$table->string('additional_family');
				$table->string('additional_names');
				$table->string('age');
				$table->string('veteran');
				$table->string('dd214');
				$table->string('last_night_residence');
				$table->string('updated_by')->nullable();
				$table->string('created_by')->nullable();
				$table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
