<?php

/**
 * Base tasks for setting up a module to test within a full Drupal environment.
 *
 * @class RoboFile
 * @codeCoverageIgnore
 */
class RoboFile extends \Robo\Tasks
{

    public function __construct()
    {
        $this->stopOnFail();
    }

    public function jobRunCodingStandardCheck() {
        return $this->taskExecStack()
        ->stopOnFail()
        ->exec('vendor/bin/phpcs --config-set installed_path vendor/drupal/coder/coder_sniffer')
        ->exec('vendor/bin/phpcs --standard=Drupal web/modules')
        ->exec('vendor/bin/phpcs --standard=DrupalPractice web/modules')
        ->run();
    }
}
