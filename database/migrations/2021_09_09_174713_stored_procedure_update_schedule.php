<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StoredProcedureUpdateSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            CREATE PROCEDURE `updateContact` (
                IN id INTEGER(11),
                IN name VARCHAR(255),
                IN email VARCHAR(255),
                IN phone VARCHAR(255),
                IN address LONGTEXT,
                IN mytimestamp TIMESTAMP
            )

            BEGIN
                UPDATE `schedules`
                SET
                    `name` = name,
                    `email` = email,
                    `phone` = phone,
                    `address` = address,
                    `updated_at` = mytimestamp
                    WHERE `schedules`.`id` = id;
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
        $procedure = "DROP PROCEDURE IF EXISTS `updateContact`;";

        DB::unprepared($procedure);
    }
}
