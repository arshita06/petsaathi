<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * We do not keep the sender's IP address — it is not needed to answer a
     * support message, so there is no reason to hold it.
     */
    public function up(): void
    {
        if (Schema::hasColumn('contact_messages', 'ip_address')) {
            Schema::table('contact_messages', function (Blueprint $table) {
                $table->dropColumn('ip_address');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('contact_messages', 'ip_address')) {
            Schema::table('contact_messages', function (Blueprint $table) {
                $table->string('ip_address', 45)->nullable();
            });
        }
    }
};
