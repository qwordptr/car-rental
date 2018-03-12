<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.03.18
 * Time: 20:44
 */

namespace AppBundle\Service\Interfaces;


use AppBundle\Entity\Notice;

interface INoticeService
{
    public function browse();
    public function get($id) : Notice;
    public function create(Notice $notice);
    public function update(Notice $notice);
    public function deactivate($noticeId);

}