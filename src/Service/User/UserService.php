<?php declare(strict_types=1);

namespace Osnova\Api\Service\User;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Common\Params\CountOffsetParams;
use Osnova\Api\Component\Model\Comment;
use Osnova\Api\Component\Model\Entry;
use Osnova\Api\Component\Model\Model;
use Osnova\Api\Component\Model\Notification;
use Osnova\Api\Component\Model\Subsite;
use Osnova\Api\Component\Model\Vacancy;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Entry\Enum\ActionEnum;
use Osnova\Api\Service\Entry\Enum\TypeEnum;
use Osnova\Api\Service\Entry\Params\IdTypeParams;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/User
 * @package Osnova\Api\Service\User
 */
class UserService extends BaseService
{
    public const SERVICE = 'User';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUser
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUser(int $id): IResponse
    {
        return $this
            ->prepareWithName($id)
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMe
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMe(): IResponse
    {
        return $this
            ->prepareWithName('me')
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeUpdates
     *
     * @param int $isRead
     * @param int|null $lastId
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeUpdates(int $isRead = 1, int $lastId = null): IResponse
    {
        return $this
            ->prepareWithName('me/updates', [
                'is_read' => $isRead,
                'last_id' => $lastId,
            ])
            ->buildEntity(Notification::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeUpdatesCount
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeUpdatesCount(): IResponse
    {
        return $this
            ->prepareWithName('me/updates/count')
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUserMeUpdatesReadId
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUserMeUpdatesReadId(int $id): IResponse
    {
        return $this
            ->prepareWithName("me/updates/read/{$id}")
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUserMeUpdatesRead
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUserMeUpdatesRead(): IResponse
    {
        return $this
            ->prepareWithName("me/updates/read/")
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserComments
     *
     * @param int $id
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserComments(int $id, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName("{$id}/comments", new CountOffsetParams($count, $offset))
            ->buildEntity(Comment::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeComments
     *
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeComments(int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName('me/comments', new CountOffsetParams($count, $offset))
            ->buildEntity(Comment::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeComments
     *
     * @param int $id
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserEntries(int $id, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName("{$id}/entries", new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeComments
     *
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeEntries(int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName('me/entries', new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeComments
     *
     * @param int $id
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserFavoritesEntries(int $id, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName("{$id}/favorites/entries", new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserFavoritesComments
     *
     * @param int $id
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserFavoritesComments(int $id, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName("{$id}/favorites/comments", new CountOffsetParams($count, $offset))
            ->buildEntity(Comment::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserFavoritesVacancies
     *
     * @param int $id
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserFavoritesVacancies(int $id, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName("{$id}/favorites/vacancies", new CountOffsetParams($count, $offset))
            ->buildEntity(Vacancy::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeFavoritesEntries
     *
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeFavoritesEntries(int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName('me/favorites/entries', new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeFavoritesComments
     *
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeFavoritesComments(int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName('me/favorites/comments', new CountOffsetParams($count, $offset))
            ->buildEntity(Comment::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeFavoritesVacancies
     *
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeFavoritesVacancies(int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName('me/favorites/vacancies', new CountOffsetParams($count, $offset))
            ->buildEntity(Vacancy::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeSubscriptionsRecommended
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeSubscriptionsRecommended(): IResponse
    {
        return $this
            ->prepareWithName('me/subscriptions/recommended')
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeSubscriptionsSubscribed
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeSubscriptionsSubscribed(): IResponse
    {
        return $this
            ->prepareWithName('me/subscriptions/subscribed')
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postFavoriteAdd
     *
     * @param int $id
     * @param TypeEnum $type
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postFavoriteAdd(int $id, TypeEnum $type): IResponse
    {
        return $this
            ->prepareWithName('me/favorites', new IdTypeParams($id, $type))
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postFavoriteRemove
     *
     * @param int $id
     * @param TypeEnum $type
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postFavoriteRemove(int $id, TypeEnum $type): IResponse
    {
        return $this
            ->prepareWithName('me/favorites/remove', new IdTypeParams($id, $type))
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getUserMeTuneCatalog
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getUserMeTuneCatalog(): IResponse
    {
        return $this
            ->prepareWithName('me/tunecatalog')
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUserMeTuneCatalog
     *
     * @param array $settings
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUserMeTuneCatalog(array $settings): IResponse
    {
        return $this
            ->prepareWithName('me/tunecatalog', ['settings' => $settings])
            ->setMethod(Method::POST)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUserMeSaveAvatar
     *
     * @param string $url
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUserMeSaveAvatar(string $url): IResponse
    {
        return $this
            ->prepareWithName('me/save_avatar', ['url' => $url])
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUserMeSaveCover
     *
     * @param string $cover
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUserMeSaveCover(string $cover): IResponse
    {
        return $this
            ->prepareWithName('me/save_cover', ['cover' => $cover])
            ->setMethod(Method::POST)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUserMeSubscription
     *
     * @param int $id
     * @param ActionEnum $action
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUserMeSubscription(int $id, ActionEnum $action): IResponse
    {
        return $this
            ->prepareWithName('me/subscribtion', [
                'id' => $id,
                'action' => $action,
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getGetIgnoredKeywords
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getGetIgnoredKeywords(): IResponse
    {
        return $this
            ->prepareWithName('me/get-ignored-keywords')
            ->buildEntity(Model::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postSubsiteIgnoreKeywords
     *
     * @param array $keywords
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postSubsiteIgnoreKeywords(array $keywords): IResponse
    {
        return $this
            ->prepareWithName('me/ignore-keywords', ['keywords' => $keywords])
            ->setMethod(Method::POST)
            ->buildEntity(Model::class)
            ->call();
    }
}
