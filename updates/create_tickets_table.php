<?php namespace Mohsin\Helpdesk\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTicketsTable extends Migration
{

    public function up()
    {
        Schema::create('mohsin_helpdesk_tickets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('subject');
            $table->mediumText('notes');
            $table->enum('status', ['new', 'resolved','waiting','progress','replied','hold'])->default('new');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mohsin_helpdesk_tickets');
    }

}
