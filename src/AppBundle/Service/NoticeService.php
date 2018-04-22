<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 08.03.18
 * Time: 20:48
 */

namespace AppBundle\Service;


use AppBundle\Entity\Notice;
use AppBundle\Repository\NoticeRepository;
use AppBundle\Service\Interfaces\INoticeService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NoticeService implements INoticeService
{
    private $repository;

    public function __construct(NoticeRepository $noticeRepository)
    {
        $this->repository = $noticeRepository;
    }

    public function browseNotActive()
    {
        $notices = $this->repository->findBy([
            'isActive' => false
        ]);

        return $notices;
    }

    public function browse(string $search = null, string $category = null)
    {
        $notices = $this->repository->browse($search, $category);

        return $notices;
    }

    public function get($id): Notice
    {
        $notice = $this->repository->find($id);

        if ($notice == null)
        {
            throw new NotFoundHttpException("Cannot find notice with id $id");
        }

        return $notice;
    }

    public function create(Notice $notice)
    {
        $notice->setCreatedAt(new \DateTime());
        $notice->setIsActive(true);

        $this->repository->add($notice);
    }

    public function update(Notice $notice)
    {
        if (!$notice->getisActive()) {
            throw new \InvalidArgumentException("Ogłosznie nie może zostać edytowane");
        }

        $this->repository->update($notice);
    }

    public function deactivate($noticeId)
    {
        $notice = $this->repository->find($noticeId);

        if ($notice === null)
        {
            throw new NotFoundHttpException("Nie ma takiego ogłoszenia.");
        }

        $notice->setIsActive(false);

        $this->repository->update($notice);
    }

    /**
     * @param $noticeId
     *
     * TODO check if notice can be removed, if is not used by order
     */
    public function remove($noticeId)
    {
        $notice = $this->repository->find($noticeId);

        if ($noticeId == null)
        {
            throw new NotFoundHttpException("Nie ma takiego ogłoszenia.");
        }

        if (!$notice->getIsActive())
        {
            throw new \InvalidArgumentException("Ogłosznie nie może zostać usunięte.");
        }

        $this->repository->remove($notice);
    }
}