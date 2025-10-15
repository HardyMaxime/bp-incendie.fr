<?php

namespace App\Providers;

abstract class AbstractProvider
{
    abstract public function register(): void;

    protected function on(string $hook, callable $cb, int $prio = 10, int $args = 1): void
    {
        add_action($hook, $cb, $prio, $args);
    }

    protected function remove(string $hook, callable $cb, int $prio = 10, int $args = 1): void
    {
        remove_action($hook, $cb, $prio, $args);
    }

    protected function filter(string $hook, callable $cb, int $prio = 10, int $args = 1): void
    {
        add_filter($hook, $cb, $prio, $args);
    }
}