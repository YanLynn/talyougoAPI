<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreatePriceByProductTypeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       DB::statement("
       CREATE OR REPLACE VIEW price_by_product_type_views
       AS
       SELECT
           price_by_product_types.id as price_id,
           price_by_product_types.price,
           price_by_product_types.product_type_id,
           product_types.type_name,
           product_types.profile_id
       FROM
           product_types
           LEFT JOIN price_by_product_types ON price_by_product_types.product_type_id = product_types.id;
       ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_by_product_type_view');
    }
}
