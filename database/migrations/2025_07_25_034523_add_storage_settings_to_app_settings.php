<?php
// database/migrations/2025_07_25_000000_add_storage_settings_to_app_settings.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->string('storage_default_disk')->nullable()->after('show_repair_status_login_screen');

            $table->longText('storage_disks')->nullable()->after('storage_default_disk');
        });
    }

    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn(['storage_default_disk', 'storage_disks']);
        });
    }
};
