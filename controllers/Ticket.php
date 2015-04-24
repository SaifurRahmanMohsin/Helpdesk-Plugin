<?php namespace Mohsin\Helpdesk\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Ticket Back-end Controller
 */
class Ticket extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Mohsin.Helpdesk', 'helpdesk', 'ticket');
    }

    public function listOverrideColumnValue($record, $columnName)
    {
        if( $columnName == "status" )
          return constant('Mohsin\Helpdesk\Classes\StatusType::st' . ucfirst($record -> status));
    }
}
