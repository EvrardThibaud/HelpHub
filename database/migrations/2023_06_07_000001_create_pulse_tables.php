<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Get the migration connection name.
     */
    public function getConnection(): ?string
    {
        return Config::get('pulse.storage.database.connection');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pulse_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('timestamp');
            $table->string('type', 255);
            $table->text('key');
            $table->uuid('key_hash')->nullable();
            $table->text('value');
            $table->timestamps();
        });

        // Set up event to update key_hash column
        \DB::unprepared('
            CREATE OR REPLACE FUNCTION update_key_hash() RETURNS trigger AS $$
            BEGIN
                NEW.key_hash = md5(NEW.key)::uuid;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        \DB::unprepared('
            CREATE TRIGGER pulse_values_before_insert BEFORE INSERT ON pulse_values
            FOR EACH ROW EXECUTE FUNCTION update_key_hash();
        ');

        \DB::unprepared('
            CREATE TRIGGER pulse_values_before_update BEFORE UPDATE ON pulse_values
            FOR EACH ROW EXECUTE FUNCTION update_key_hash();
        ');
    }

    public function down()
    {
        Schema::dropIfExists('pulse_values');
    }
};
