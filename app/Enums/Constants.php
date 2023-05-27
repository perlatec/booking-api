<?php

namespace App\Enums;

abstract class Constants
{

    /**
     * ELEMENTS_PER_PAGE
     */
    public const ELEMENTS_PER_PAGE = 15;

    /**
     * -----------------------------------------
     *	Roles
     * -----------------------------------------
     */

    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_AGENT = 'AGENT';
    public const ROLE_CLIENT = 'CLIENT';
    public const ROLE_COMERCIAL = 'COMERCIAL';
    public const ROLE_DEVELOPER = 'DEVELOPER';

    /**
     * ROLE_ALL
     *
     * @param  bool $asString
     * @return array|string
     */
    static public function ROLE_ALL(bool $asString = false): array|string
    {
        $roles = [
            self::ROLE_ADMIN,
            self::ROLE_AGENT,
            self::ROLE_CLIENT,
            self::ROLE_COMERCIAL,
            self::ROLE_DEVELOPER,
        ];
        return $asString
            ? implode(',', $roles)
            : $roles;
    }

    /**
     * ROLES_SUDOERS
     *
     * @param  mixed $asString
     * @return array|string
     */
    static public function ROLES_SUDOERS(bool $asString = false): array|string
    {
        $roles = [
            self::ROLE_ADMIN,
            self::ROLE_DEVELOPER,
        ];
        return $asString
            ? implode(',', $roles)
            : $roles;
    }
    /**
     * -----------------------------------------
     *	Status
     * -----------------------------------------
     */

    public const STATUS_CREATED = 'CREATED';
    public const STATUS_ACCEPTED = 'ACCEPTED';
    public const STATUS_ONPROGRESS = 'ONPROGRESS';
    public const STATUS_CANCELED_BY_CLIENT = 'CANCELED_BY_CLIENT';
    public const STATUS_CANCELED_BY_PROVIDER = 'CANCELED_BY_PROVIDER';
    public const STATUS_COMPLETED = 'COMPLETED';
    public const STATUS_UNKNOWN = 'UNKNOWN';

    /**
     * STATUS_UPDATABLES
     *
     * @param bool $asString
     * @return array|string
     */
    static public function STATUS_UPDATABLES(bool $asString = false): array|string
    {
        $status = [
            self::STATUS_ACCEPTED,
            self::STATUS_CANCELED_BY_CLIENT,
            self::STATUS_CANCELED_BY_PROVIDER,
            self::STATUS_COMPLETED,
            self::STATUS_ONPROGRESS,
            self::STATUS_UNKNOWN
        ];
        return $asString
            ? implode(',', $status)
            : $status;
    }
}
