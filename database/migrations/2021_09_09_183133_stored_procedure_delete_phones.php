<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoredProcedureDeletePhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            CREATE PROCEDURE `deletePhone` (
                IN schedule_id INTEGER(11)
            )

            BEGIN
                DELETE FROM `phones` WHERE `phones`.`schedule_id` = schedule_id;
            END
        ";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `deletePhone`;";

        DB::unprepared($procedure);
    }
}
