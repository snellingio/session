<?php
declare (strict_types=1);

namespace Snelling;

use Predis\Session\Handler as SessionHandler;

class Session
{

    /**
     * Session constructor.
     * @param Redis $redis
     */
    public function __construct(Redis $redis)
    {
        $this->sessionHandler = new SessionHandler($redis->instance(), ['gc_maxlifetime' => 86400]);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $_SESSION;
    }

    /**
     * @param string $key
     * @return mixed|bool
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        return false;
    }

    /**
     * @param string $key
     * @param        $value
     * @return bool
     */
    public function set(string $key, $value): bool
    {
        $_SESSION[$key] = $value;

        return true;
    }

    /**
     * @return bool
     */
    public function start(): bool
    {
        if (session_status() === PHP_SESSION_NONE || $this->all() === null) {
            $this->sessionHandler->register();
            session_start();
        }

        return true;
    }
}