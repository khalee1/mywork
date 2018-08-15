<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/15/18
 * Time: 2:25 PM
 */

namespace Kd\Core\Verify;

use Kd\Core\Verify\PostException as PostEx;

class Verify_Data
{
    /**
     * @param int $number
     *
     * @return bool
     *
     * @throws \Exception("Input must number")
     *
     * @author khaln@tech.est-rouge.com
     */
    static function checkIsNumberGreaterThanZero($number)
    {
        if (!filter_var($number, FILTER_VALIDATE_INT))
            throw  new \Exception("It must be number");

        if ($number<=0)
            throw  new \Exception("Input must greater than 0");

        return true;
    }

    /**
     * @param var $param \
     *
     * @return bool
     *
     * @throws \Exception("Input not null")
     *
     * @author khaln@tech.est-rouge.com
     */
    static function checkNotNull($param)
    {
        if (empty($param))
            throw  new \Exception("Not found Data");

        return true;
    }

    /**
     * @param \DateTime $dayStart
     *
     * @param \DateTime $dayEnd
     *
     * @return bool
     *
     * @throws \Exception("Date Start less than date end")
     *
     * @author khaln@tech.est-rouge.com
     */
    static function checkIsDateStartLessThanDateEnd($dayStart, $dayEnd)
    {
        $dayStart = new \DateTime($dayStart);
        $dayEnd = new \DateTime($dayEnd);

        if ($dayStart > $dayEnd)
            throw  new \Exception("Date Start less than date end");

        return true;
    }

    /**
     * @param array $listKey
     *
     * @param post request $post
     *
     * @return bool
     *
     * @throws \Kd\Core\Verify\PostException("$key not null")
     *
     * @author khaln@tech.est-rouge.com
     */
    static function checkPost($listKey, $post)
    {
        foreach ($listKey as $key) {
            if (empty($post[$key])) throw new PostEx("$key not null");
        }
        return true;
    }
}