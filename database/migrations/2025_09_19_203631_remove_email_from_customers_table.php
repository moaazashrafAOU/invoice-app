<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // لو العمود موجود احذفه
            if (Schema::hasColumn('customers', 'email')) {
                $table->dropColumn('email');
            }
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // لو حبينا نرجّع التغيير نعيد العمود ويمكن نخليه nullable
            $table->string('email')->nullable()->after('name');
        });
    }
};
