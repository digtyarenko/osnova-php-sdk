<?php declare(strict_types=1);

namespace Osnova\Api\Service\Entry;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Component\Model\Attach;
use Osnova\Api\Component\Model\Entry;
use Osnova\Api\Component\Model\Likes;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Entry\Enum\SignEnum;
use Osnova\Api\Service\Entry\Enum\TypeStringEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Entry
 * @package Osnova\Api\Service\Entry
 */
class EntryService extends BaseService
{
    public const SERVICE = 'Entry';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryById
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getEntryById(int $id): IResponse
    {
        return $this
            ->prepareWithName($id)
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryWidgets
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getEntryWidgets(int $id): IResponse
    {
        return $this->prepareWithName("{$id}/widgets")->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postEntryCreate
     * @see https://www.notion.so/73acb29bca4848d88ac6545e5775a987
     *
     * @param int $subsiteId
     * @param string $title
     * @param Entry $entry
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postEntryCreate(int $subsiteId, string $title, Entry $entry): IResponse
    {
        return $this
            ->prepareWithName('create', [
                'subsite_id' => $subsiteId,
                'title' => $title,
                'entry' => $entry,
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postEntryCreate
     * @see https://www.notion.so/73acb29bca4848d88ac6545e5775a987
     *
     * @param int $subsiteId
     * @param string $title
     * @param string $text
     * @param string|null $attachments
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postEntryCreateSimple(int $subsiteId, string $title, string $text, string $attachments = null): IResponse
    {
        return $this
            ->prepareWithName('create', [
                'subsite_id' => $subsiteId,
                'title' => $title,
                'text' => $text,
                'attachments' => $attachments,
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getPopularEntries
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getPopularEntries(int $id): IResponse
    {
        return $this
            ->prepareWithName("{$id}/popular")
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postLikeEntry
     *
     * @param int $id
     * @param TypeStringEnum $type
     * @param SignEnum $sign
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postLikeEntry(int $id, TypeStringEnum $type, SignEnum $sign): IResponse
    {
        return $this
            ->prepare('like', [
                'id' => $id,
                'type' => $type,
                'sign' => $sign,
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Likes::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryLocate
     *
     * @param string $url
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getEntryLocate(string $url): IResponse
    {
        return $this
            ->prepareWithName('locate', ['url' => $url])
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postEntryAttachEmbed
     *
     * @param string $url
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postEntryAttachEmbed(string $url): IResponse
    {
        return $this
            ->prepareWithName('attachEmbed', ['url' => $url])
            ->setMethod(Method::POST)
            ->buildEntity(Attach::class)
            ->call();
    }
}
