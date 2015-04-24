<?php namespace Mohsin\Helpdesk\Classes;

abstract class StatusType {
    const stNew       = 'New';
    const stResolved  = 'Waiting reply';
    const stWaiting   = 'Replied';
    const stProgress  = 'Resolved';
    const stReplied   = 'In Progress';
    const stHold      = 'On Hold';
}
