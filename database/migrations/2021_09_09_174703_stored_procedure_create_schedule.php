<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoredProcedureCreateSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            CREATE PROCEDURE `createContact` (
                IN name VARCHAR(255),
                IN email VARCHAR(255),
                IN phone VARCHAR(255),
                IN address LONGTEXT,
                IN mytimestamps TIMESTAMP
            )

            BEGIN
                INSERT INTO `schedules`(`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
                ( NULL, name, email, phone, address, mytimestamps, mytimestamps, NULL );
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
        $procedure = "DROP PROCEDURE IF EXISTS `createContact`;";

        DB::unprepared($procedure);
    }
}
