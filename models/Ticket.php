<?php namespace Mohsin\Helpdesk\Models;

use Model;
use RainLab\User\Models\User;
use Mohsin\Helpdesk\Classes\StatusType;

/**
 * Ticket Model
 */
class Ticket extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'user_id'    => 'required',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mohsin_helpdesk_tickets';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => ['RainLab\User\Models\User']
    ];

    public function getStatusOptions($fieldName = null, $keyValue = null)
    {
        return [
          'new'       => StatusType::stNew,
          'resolved'  => StatusType::stResolved,
          'waiting'   => StatusType::stWaiting,
          'progress'  => StatusType::stProgress,
          'replied'   => StatusType::stReplied,
          'hold'      => StatusType::stHold,
        ];
    }

    public function getUserIdOptions($fieldName = null, $keyValue = null)
    {
        return User::all()->lists('name', 'id');
    }

    public $attributeNames = [
        'user_id' => 'Name',
    ];

    public $customMessages = [
        'required' => 'The :attribute field is required.',
    ];

}
