<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Single column indexes
            $table->index('CID');
            $table->index('years');
            $table->index('Roll');
            $table->index('reg_id');

            // Composite index for frequently searched columns together
            $table->index(['CID', 'years', 'Roll', 'reg_id']);
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex(['CID']);
            $table->dropIndex(['years']);
            $table->dropIndex(['Roll']);
            $table->dropIndex(['reg_id']);
            $table->dropIndex(['CID', 'years', 'Roll', 'reg_id']);
        });
    }
}
