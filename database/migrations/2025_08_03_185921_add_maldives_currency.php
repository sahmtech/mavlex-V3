<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!DB::table('currencies')->where('code', 'MVR')->exists()) {
            DB::table('currencies')->insert([
                'id'                  => 142,
                'country'             => 'Maldives',
                'currency'            => 'Rufiyaa',
                'code'                => 'MVR',
                'symbol'              => 'Rf',
                'thousand_separator'  => ',',
                'decimal_separator'   => '.',
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
    }

    public function down(): void
    {
      //  DB::table('currencies')->where('code', 'MVR')->delete();
    }
};
