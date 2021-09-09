<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoredProcedureCreatePhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            CREATE PROCEDURE `createPhone` (
                IN schedule_id INTEGER,
                IN phone VARCHAR(255),
                IN mytimestamps TIMESTAMP
            )

            BEGIN
                INSERT INTO `phones`(`id`, `schedule_id`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
                ( NULL, schedule_id, phone, mytimestamps, mytimestamps, NULL );
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
        $procedure = "DROP PROCEDURE IF EXISTS `createPhone`;";

        DB::unprepared($procedure);
    }
}
