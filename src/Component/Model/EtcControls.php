<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class EtcControls
 * @package Osnova\Api\Component\Model
 */
class EtcControls extends Model
{
    public bool $edit_entry;
    public bool $pin_content;
    public bool $unpublish_entry;
    public bool $ban_subsite;
    public bool $pin_comment;
    public bool $remove;
    public bool $remove_thread;
}
