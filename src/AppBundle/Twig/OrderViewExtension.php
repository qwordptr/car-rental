<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.04.18
 * Time: 12:13
 */

namespace AppBundle\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class OrderViewExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('getStatus', [$this, 'getStatus'], ['is_safe' => ['html']]),
        );
    }

    public function getStatus($status)
    {
        $status_arr['pending'] = '<span class="btn btn-info">Oczekuje na akceptację</span>';
        $status_arr['approved'] = '<span class="btn btn-success">Zatwierdzone/pojazd oczekuje</span>';
        $status_arr['in_progress'] = '<span class="btn btn-success">Pojazd u klienta</span>';
        $status_arr['finished_successfully'] = '<span class="btn btn-success">Zakończono/zwrócono</span>';
        $status_arr['finished_with_comments'] = '<span class="btn btn-warning">Zakończono/uwagi</span>';
        $status_arr['rejected'] = '<span class="btn btn-danger">Odrzucone</span>';

        return $status_arr[$status];
    }
}