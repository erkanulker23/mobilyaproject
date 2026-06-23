<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('order_column')->default(0);
            $table->timestamps();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('project_category_id')->nullable()->after('category')
                ->constrained('project_categories')->nullOnDelete();
        });

        // Mevcut string kategorileri ProjectCategory'e taşı ve projelere bağla
        $defaults = [
            'villa' => 'Villa', 'rezidans' => 'Rezidans', 'ticari' => 'Ticari',
            'konut' => 'Konut', 'altyapi' => 'Altyapı',
        ];
        $existing = DB::table('projects')->whereNotNull('category')->distinct()->pluck('category')->filter()->all();
        $order = 1;
        $map = [];
        foreach ($defaults as $slug => $name) {
            $id = DB::table('project_categories')->insertGetId([
                'name' => $name, 'slug' => $slug, 'order_column' => $order++,
                'created_at' => now(), 'updated_at' => now(),
            ]);
            $map[$slug] = $id;
        }
        // Varsayılanlarda olmayan kategoriler
        foreach ($existing as $cat) {
            $slug = Str::slug($cat);
            if (! isset($map[$slug])) {
                $id = DB::table('project_categories')->insertGetId([
                    'name' => Str::title($cat), 'slug' => $slug, 'order_column' => $order++,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
                $map[$slug] = $id;
            }
        }
        // Projelere ata
        foreach (DB::table('projects')->whereNotNull('category')->get() as $p) {
            $slug = Str::slug($p->category);
            if (isset($map[$slug])) {
                DB::table('projects')->where('id', $p->id)->update(['project_category_id' => $map[$slug]]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_category_id');
        });
        Schema::dropIfExists('project_categories');
    }
};
