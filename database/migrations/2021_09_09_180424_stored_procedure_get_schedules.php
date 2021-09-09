<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoredProcedureGetSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            CREATE PROCEDURE `getContacts` (
                IN with_trashed INTEGER(11)
            )

            BEGIN
                IF with_trashed = 0 THEN
                    SELECT * FROM `schedules` WHERE deleted_at IS NULL;
                ELSE
                    SELECT * FROM `schedules` WHERE deleted_at IS NOT NULL;
                END IF;
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
        $procedure = "DROP PROCEDURE IF EXISTS `getContacts`;";

        DB::unprepared($procedure);
    }
}
