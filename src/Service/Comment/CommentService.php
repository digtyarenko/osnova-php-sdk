<?php declare(strict_types=1);

namespace Osnova\Api\Service\Comment;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Component\Model\Comment;
use Osnova\Api\Component\Model\Custom\EntryCommentsLevelsGetObject;
use Osnova\Api\Component\Model\Model;
use Osnova\Api\Exception\InvalidEntityClassException;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Exception\InvalidTokenException;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\UnexpectedMethodException;
use Osnova\Api\Exception\UnexpectedResultTypeException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Comment\Enum\SortingEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Comment
 * @package Osnova\Api\Service\Comment
 */
class CommentService extends BaseService
{
    public const SERVICE = 'Comment';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryComments
     *
     * @param int $id
     * @param SortingEnum $sorting
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedMethodException
     * @throws UnexpectedResultTypeException
     */
    public function getEntryComments(int $id, SortingEnum $sorting): IResponse
    {
        return $this
            ->prepare(sprintf('entry/%d/comments/%s', $id, (string) $sorting))
            ->buildEntity(Comment::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryCommentsLevelsGet
     *
     * @param int $id
     * @param SortingEnum $sorting
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedMethodException
     * @throws UnexpectedResultTypeException
     */
    public function getEntryCommentsLevelsGet(int $id, SortingEnum $sorting): IResponse
    {
        return $this
            ->prepare(sprintf('entry/%d/comments/levels/%s', $id, (string) $sorting))
            ->buildEntity(EntryCommentsLevelsGetObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryCommentsThread
     *
     * @param int $entryId
     * @param int $commentId
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedMethodException
     * @throws UnexpectedResultTypeException
     */
    public function getEntryCommentsThread(int $entryId, int $commentId): IResponse
    {
        return $this
            ->prepare(sprintf('entry/%d/comments/thread/%d', $entryId, $commentId))
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postCommentSend
     *
     * @param int $id
     * @param string $text
     * @param int $replyTo
     * @param string|null $attachments
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedMethodException
     * @throws UnexpectedResultTypeException
     */
    public function postCommentSend(int $id, string $text, int $replyTo = 0, string $attachments = null): IResponse
    {
        return $this
            ->prepareWithName('add', [
                'id' => $id,
                'text' => $text,
                'reply_to' => $replyTo,
                'attachments' => $attachments
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Comment::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postCommentEdit
     *
     * @param int $entryId
     * @param int $commentId
     * @param string $text
     * @param string|null $attachments
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function postCommentEdit(int $entryId, int $commentId, string $text, string $attachments = null): IResponse
    {
        return $this
            ->prepareWithName('edit', [
                'entryId' => $entryId,
                'commentId' => $commentId,
                'text' => $text,
                'attachments' => $attachments
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }
}
