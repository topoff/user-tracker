<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Topoff\LaravelUserLogger\Support\Migration;

class CreateReferersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::connection($this->connection)->create('referers', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->bigInteger('domain_id')->unsigned();
                $table->string('url')->unique()->index();
//                $table->string('host')->index();
                $table->string('medium', 40)->nullable()->index();
                $table->string('source', 30)->nullable()->index();
                $table->string('search_terms')->nullable()->index();

                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

                $table->foreign('domain_id')->references('id')->on('domains');
            });
        } catch (Exception $e){
            dd($e);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->dropIfExists('referers');
    }
}
