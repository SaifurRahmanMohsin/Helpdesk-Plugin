<?php namespace Mohsin\Helpdesk;

use Event;
use Backend;
use ApplicationException;
use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;

/**
 * Helpdesk Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
          'name'        => 'Helpdesk',
          'description' => 'User support and ticket system',
          'author'      => 'Mohsin',
          'icon'        => 'icon-user'
        ];
    }

    public function boot()
    {
        UserModel::extend(function($model){
          $model -> hasMany['tickets'] = ['Mohsin\Helpdesk\Models\Ticket'];
          $model->bindEvent('model.beforeDelete', function() use ($model) {
            foreach($model->tickets as $ticket)
              $ticket -> delete();
            });
        });
    }

    public function registerNavigation()
    {
        return [
          'helpdesk' => [
            'label'       => 'Helpdesk',
            'url'         => Backend::url('mohsin/helpdesk/ticket'),
            'icon'        => 'icon-phone',
            'permissions' => ['mohsin.helpdesk.*'],
            'order'       => 500,

            'sideMenu' => [
              'tickets' => [
                  'label'       => 'Tickets',
                  'icon'        => 'icon-th-list',
                  'url'         => Backend::url('mohsin/helpdesk/tickets'),
                  'permissions' => ['mohsin.helpdesk.access_tickets'],
              ],
            ]
          ]
        ];
    }

    public function registerComponents()
    {
        return [
          'Mohsin\Helpdesk\Components\Tickets' => 'tickets'
        ];
    }

    public function registerPermissions()
    {
        return [
          'mohsin.helpdesk.access_tickets'  => ['tab' => 'Users', 'label' => 'Manage Tickets']
        ];
    }

    public function registerMarkupTags()
    {
        return [
          'filters' => [
            'st' => function($status) { return constant('Mohsin\Helpdesk\Classes\StatusType::st' . ucfirst($status)); }
          ]
        ];
    }
}
