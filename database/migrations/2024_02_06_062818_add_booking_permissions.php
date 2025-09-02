<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AddBookingPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create booking related permissions
        Permission::create(['name' => 'crud_all_bookings', 'guard_name' => 'web']);
        Permission::create(['name' => 'crud_own_bookings', 'guard_name' => 'web']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the created permissions
        Permission::where('name', 'crud_all_bookings')->delete();
        Permission::where('name', 'crud_own_bookings')->delete();
    }
}
