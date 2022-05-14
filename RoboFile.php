<?php

/**
 * Base tasks for setting up a module to test within a full Drupal environment.
 *
 * @class RoboFile
 * @codeCoverageIgnore
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Implements constructor
     */
    public function __construct() {
        $this->stopOnFail();
    }

    /**
     * Run coding standard validation.
     *
     * @return void
     */
    public function jobRunCodingStandardCheck() {
        return $this->taskExecStack()
        ->stopOnFail()
        ->exec('vendor/bin/phpcs --config-set installed_path vendor/drupal/coder/coder_sniffer')
        ->exec('vendor/bin/phpcs --standard=Drupal web/modules/custom')
        ->exec('vendor/bin/phpcs --standard=DrupalPractice web/modules/custom')
        ->run();
    }
    /**
     * Run test.
     *
     * @return void
     */
    public function jobRunUnitTest() {
        return $this->taskExecStack()
        ->stopOnFail()
        ->exec('ddev exec -s web vendor/bin/phpunit -c web/core --verbose web/modules/custom')
        ->run();
    }
}
