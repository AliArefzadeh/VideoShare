<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            //قابلیت cascade در onDelete('cascade') برای این هست که اگر این کتگوری دلیت شد ویدیوهای مربوط به آن هم دلیت بشن.
            //قابلیت set null در onDelete('set null') برای این هست که اگر این کتگوری دلیت شد ویدیوهای مربوط به آن دلیت نشوند و فقط ستون category_id تبدیل به null شود.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            //اگر موقع رول بک کردن به ارور برخوردی خط بالا رو اضافه کن
            $table->dropColumn('category_id');
        });
    }
}
